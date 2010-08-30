<?php
/* SVN FILE: $Id$ */
/**
 * SassScriptFunction class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.script
 */

require_once('SassScriptFunctions.php');

/**
 * SassScriptFunction class.
 * Preforms a SassScript function.
 * @package			PHamlP
 * @subpackage	Sass.script
 */
class SassScriptFunction {
	/**@#+
	 * Regexes for matching and extracting colours
	 */
	const MATCH = '/^(\w+)\((.+)\)/';
	const NAME = 1;
	const ARGUMENTS = 2;

	private $name;
	private $args;

	/**
	 * SassScriptFunction constructor
	 * @param string name of the function
	 * @param array arguments for the function
	 * @return SassScriptFunction
	 */
	public function __construct($name, $args) {
		$this->name = $name;
		$this->args = $args;
	}

	/**
	 * Evaluates the function.
	 * @return Function the value of this Function
	 */
	public function perform() {
		static $functions;
		
		if (empty($functions)) {
			$functions = new SassScriptFunctions();
		}
		
		if (method_exists($functions, $this->name)) {
			return call_user_func_array(array($functions, $this->name), $this->args);
		}
		else {
			$args = array();
			foreach ($this->args as $arg) {
				$args[] = $arg->toString();
			}
			return new SassString($this->name . '(' . join(', ', $args) . ')');
		}
	}

	/**
	 * Returns a value indicating if a token of this type can be matched at
	 * the start of the subject string.
	 * @param string the subject string
	 * @return mixed match at the start of the string or false if no match
	 */
	public static function isa($subject) {
		return (preg_match(self::MATCH, $subject, $matches) ? $matches[0] : false);
	}
}
