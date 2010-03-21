<?php
/* SVN FILE: $Id$ */
/**
 * SassCalculator class file.
 * Calculates values from expressions
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

require_once('SassScriptLexer.php');
require_once('SassScriptParserExceptions.php');

/**
 * SassCalculator class
 * @author Chris Yates
 * @package sass
 */
class SassScriptParser {
	/**
	 * @var SassScriptLexer the lexer object
	 */
	private $lexer;

	/**
	* SassScriptParser constructor.
	* @return SassScriptParser
	*/
	public function __construct() {
		$this->lexer = new SassScriptLexer();
	}

	/**
	 * Parse SassScript.
	 * @param string expression to parse
	 * @return string parsed value
	 */
	public function parse($expression) {
		return $this->calculate($this->lexer->lex($expression))->value;
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
			elseif (!$token instanceof SassScriptOperation) {
				array_push($operands, $token);
			}
			else {
				$args = array();
				for ($i = 0, $c = $token->operandCount; $i < $c; $i++) {
					$args[] = array_shift($operands);
				}
				array_push($operands, $token->perform($args));
			}
		}
	  return array_pop($operands);
	}
}