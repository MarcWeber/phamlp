<?php
/* SVN FILE: $Id$ */
/**
 * SassScriptParser class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.script
 */

require_once('SassScriptLexer.php');
require_once('SassScriptParserExceptions.php');

/**
 * SassScriptParser class.
 * Parses SassScript. SassScript is lexed into {@link http://en.wikipedia.org/wiki/Reverse_Polish_notation Reverse Polish notation} by the SassScriptLexer and
 *  the calculated result returned.
 * @package			PHamlP
 * @subpackage	Sass.script
 */
class SassScriptParser {
	const MATCH_INTERPOLATION = '/(?<!\\\\)#\{(.*?)\}/';
	
	/**
	 * @var SassContext Used for error reporting
	 */
	public static $context;

	/**
	 * @var SassScriptLexer the lexer object
	 */
	private $lexer;

	/**
	* SassScriptParser constructor.
	* @return SassScriptParser
	*/
	public function __construct() {
		$this->lexer = new SassScriptLexer($this);
	}

	/**
	 * Evaluate SassScript.
	 * CSS allows "/" to appear in property values as a way of separating numbers.
	 * To support this while also allowing "/" to be used for division we check to
	 * for the "/" operator and if present determine if division it to take place.
	 * There are three situations where the "/" will be interpreted as division:
	 * 1. If the expression contains a variable.
	 * 2. If the operator is surrounded by parentheses.
	 * 3. If the expression contains another operator.
	 * If division is not to take place the expression is returned.
	 * @param string expression to parse
	 * @param SassContext the context in which the expression is parsed
	 * @return SassLiteral parsed value
	 */
	public function evaluate($expression, $context) {
		self::$context = $context;
		// If expression contains a division operator determine if we do division
		$division = strpos($expression, '/');
		if ($division && !(preg_match('/[\$!]\w+/', $expression) || (strpos($expression, '(') < $division && strpos($expression, ')', $division)) || (preg_match('/[-*\^%+!|~&<>]|<<|>>|<=|>=|and|or|xor|not/i', $expression) || strpos($expression, '/', $division+1)))) {
			$result = new SassString(trim($expression));
		}
		else {
			$result = $this->parse($expression, $context);
		}
		return $result;
	}

	/**
	 * Replace interpolated SassScript contained in '#{}' with the parsed value.
	 * @param string the text to interpolate
	 * @param SassContext the context in which the string is interpolated
	 * @return string the interpolated text
	 */
	public function interpolate($string, $context) {
		for ($i = 0, $n = preg_match_all(self::MATCH_INTERPOLATION, $string, $matches);
				$i < $n; $i++) {
			$matches[1][$i] = $this->evaluate($matches[1][$i], $context)->toString();
		}
	  return str_replace($matches[0], $matches[1], $string);
	}

	/**
	 * Parse SassScript to a SassLiteral
	 * @param string expression to parse
	 * @param SassContext the context in which the expression is parsed
	 * @return SassLiteral parsed value
	 */
	public function parse($expression, $context) {
		return $this->calculate($this->lexer->lex($expression, $context), $context);
	}

	/**
	 * Calculates a value from the tokens.
	 * @param array tokens in RPN
	 * @return SassLiteral SassLiteral object containing the result
	 */
	private function calculate($tokens) {
		$operands = array();

		while (count($tokens)) {
			$token = array_shift($tokens);
			if ($token instanceof SassScriptFunction) {
				array_push($operands, $token->perform());
			}
			elseif ($token instanceof SassLiteral) {
				if ($token instanceof SassString) {
					$token = new SassString($this->interpolate($token->toString(), self::$context));
				}
				array_push($operands, $token);
			}
			else {
				$args = array();
				for ($i = 0, $c = $token->operandCount; $i < $c; $i++) {
					$args[] = array_pop($operands);
				}
				array_push($operands, $token->perform($args));
			}
		}
	  return array_shift($operands);
	}
}