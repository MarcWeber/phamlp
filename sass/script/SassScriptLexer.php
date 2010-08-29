<?php
/* SVN FILE: $Id$ */
/**
 * SassScriptLexer class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.script
 */

require_once('literals/SassBoolean.php');
require_once('literals/SassColour.php');
require_once('literals/SassNumber.php');
require_once('literals/SassString.php');
require_once('SassScriptFunction.php');
require_once('SassScriptOperation.php');
require_once('SassScriptVariable.php');

/**
 * SassScriptLexer class.
 * Lexes SassSCript into tokens for the parser.
 * 
 * Implements a {@link http://en.wikipedia.org/wiki/Shunting-yard_algorithm Shunting-yard algorithm} to provide {@link http://en.wikipedia.org/wiki/Reverse_Polish_notation Reverse Polish notation} output.
 * @package			PHamlP
 * @subpackage	Sass.script
 */
class SassScriptLexer {
	const MATCH_WHITESPACE = '/^\s+/';
	
	/**
	 * @var array operators with meaning in uquoted strings;
	 * selectors, property names and values
	 */
	static private $_operators = array(',', '#{');

	/**
	 * @var SassScriptParser the parser object
	 */
	private $parser;

	/**
	* SassScriptLexer constructor.
	* @return SassScriptLexer
	*/
	public function __construct($parser) {
		$this->parser = $parser;
	}

	/**
	 * Lex a string into SassScript tokens and transform to
	 * Reverse Polish Notation using the Shunting Yard Algorithm.
	 * @param string string to lex
	 * @param SassContext the context in which the expression is lexed
	 * @return array tokens in RPN
	 */
	public function lex($string, $context) {
		$outputQueue = array();
		$operatorStack = array();
		
		$tokens = $this->tokenise($string, $context);

		foreach($tokens as $i=>$token) {
			// If two literals are seperated by whitespace use the concat operator
			if (empty($token) && $i > 0) {
				if (!$tokens[$i-1] instanceof SassScriptOperation &&
						!$tokens[$i+1] instanceof SassScriptOperation) {
					$token = new SassScriptOperation(SassScriptOperation::$defaultOperator, $context);
				}
				else {
					continue;
				}				
			}
			elseif ($token instanceof SassScriptVariable) {
				$token = $token->evaluate($context);
			}

			// If the token is a number or function add it to the output queue.
 			if ($token instanceof SassLiteral || $token instanceof SassScriptFunction) {
				array_push($outputQueue, $token);
			}
			// If the token is an operation
			elseif ($token instanceof SassScriptOperation) {
				// If the token is a left parenthesis push it onto the stack.
				if ($token->operator == SassScriptOperation::$operators['('][0]) {
					array_push($operatorStack, $token);
				}
				// If the token is a right parenthesis:
				elseif ($token->operator == SassScriptOperation::$operators[')'][0]) {
					while ($c = count($operatorStack)) {
						// If the token at the top of the stack is a left parenthesis
						if ($operatorStack[$c - 1]->operator == SassScriptOperation::$operators['('][0]) { 							// Pop the left parenthesis from the stack, but not onto the output queue.
							array_pop($operatorStack);
							break;
						}
						// else pop the operator off the stack onto the output queue.
						array_push($outputQueue, array_pop($operatorStack));
					}
					// If the stack runs out without finding a left parenthesis
					// there are mismatched parentheses.
					if ($c == 0) {
						throw new SassScriptLexerException('Unmatched parentheses', array(), $context->node);
					}
				}
				// the token is an operator, o1, so:
				else {
					// while there is an operator, o2, at the top of the stack
					while ($c = count($operatorStack)) {
						$operation = $operatorStack[$c - 1];
						// if o2 is left parenthesis, or
						// the o1 has left associativty and greater precedence than o2, or
						// the o1 has right associativity and lower or equal precedence than o2
						if (($operation->operator == SassScriptOperation::$operators['('][0]) ||
							($token->associativity == 'l' && $token->precedence > $operation->precedence) ||
							($token->associativity == 'r' && $token->precedence <= $operation->precedence)) {
							break; // stop checking operators
						}
						//pop o2 off the stack and onto the output queue
						array_push($outputQueue, array_pop($operatorStack));
					}
					// push o1 onto the stack
					array_push($operatorStack, $token);
				}
			}
		}

		// When there are no more tokens
		while ($c = count($operatorStack)) { // While there are operators on the stack:
			if ($operatorStack[$c - 1]->operator !== SassScriptOperation::$operators['('][0]) {
				array_push($outputQueue, array_pop($operatorStack));
			}
			else {
				throw new SassScriptLexerException('Unmatched parentheses', array(), SassScriptParser::$context->node);
			}
		}
		return $outputQueue;
	}

	/**
	 * Create tokens from the string.
	 * @param string string to tokenise
	 * @param SassContext the context in which the string is tokenised
	 * @return array tokens
	 */
	private function tokenise($string, $context) {
		$tokens = array();
		while ($string !== false) {
			if (($match = $this->isWhitespace($string)) !== false) {
				$tokens[] = null;
			}
			elseif (($match = SassString::isa($string)) !== false) {
				$tokens[] = new SassString($match);
			}
			elseif (($match = SassScriptFunction::isa($string)) !== false) {
				preg_match(SassScriptFunction::MATCH, $match, $matches);
				foreach ($this->tokenise($matches[SassScriptFunction::ARGUMENTS], $context) as $arg) {
					if (empty($arg) || ($arg instanceof SassScriptOperation && $arg->operator === 'comma')) {
						continue;
					}
					elseif ($arg instanceof SassScriptVariable) {
						$args[] = $arg->evaluate($context);
					}
					elseif ($arg instanceof SassScriptFunction) {
						$args[] = $arg->perform();
					}
					else {
						$args[] = $arg;
					}					
				}
				$tokens[] = new SassScriptFunction(
						$matches[SassScriptFunction::NAME], $args);
			}
			elseif (($match = SassBoolean::isa($string)) !== false) {
				$tokens[] = new SassBoolean($match);
			}
			elseif (($match = SassColour::isa($string)) !== false) {
				$tokens[] = new SassColour($match);
			}
			elseif (($match = SassNumber::isa($string)) !== false) {				
				$tokens[] = new SassNumber($match);
			}
			elseif (($match = SassScriptOperation::isa($string)) !== false) {
				$tokens[] = new SassScriptOperation($match);
			}
			elseif (($match = SassScriptVariable::isa($string)) !== false) {
				$tokens[] = new SassScriptVariable($match);
			}
			else {
				$_string = $string;
				$match = '';
				while (strlen($_string) && !$this->isWhitespace($_string)) {
					foreach (self::$_operators as $operator) {
						if (substr($_string, 0, strlen($operator)) == $operator) {
							break 2;
						}
					}
					$match .= $_string[0];
					$_string = substr($_string, 1);			
				}
				$tokens[] = new SassString($match);
			}			
			$string = substr($string, strlen($match));
		}
		return $tokens; 
	}

	/**
	 * Returns a value indicating if a token of this type can be matched at
	 * the start of the subject string.
	 * @param string the subject string
	 * @return mixed match at the start of the string or false if no match
	 */
	public function isWhitespace($subject) {
		return (preg_match(self::MATCH_WHITESPACE, $subject, $matches) ? $matches[0] : false);
	}
}
