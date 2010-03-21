<?php
/* SVN FILE: $Id$ */
/**
 * SassString class file.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

/**
 * SassString class.
 * Provides operations and type testing for Sass strings.
 * @package sass
 * @author Chris Yates
 */
class SassString extends SassLiteral {
  const MATCH = '/^"(.*?)"/';

	/**
	 * Class constructor
	 * @param string value of the literal type
	 * @return SassString
	 */
	public function __construct($value = null) {
		$this->value = substr($value, 1, -1);
	}

	/**
	 * String addition.
	 * If other is a SassString its value is concatenated to the value of this.
	 * If other is a SassNumber the value of this is repeated other times
	 * @param mixed value(sassString or sassNumber) to subtract
	 * @return sassString the string result
	 */
	public function _add($other) {
		if ($other instanceof SassString) {
			if ($other->hasUnits()) {
				throw new SassStringException("Number is not unitless: $other");
			}
			$this->value = str_repeat($this->value, $other->value);
		}
		else {
			$this->value .= $other->value;
		}
		return $this;
	}

	/**
	 * String subtraction.
	 * If other is a SassString its value is removed from the value of this.
	 * If other is a SassNumber that number of characters are removed from
	 * the class string; positive - from the start, negative - from the end
	 * @param mixed value(sassString or sassNumber) to subtract
	 * @return sassString the string result
	 */
	public function _subtract($other) {
		if ($other instanceof SassString) {
			if ($other->hasUnits()) {
				throw new SassStringException("Number is not unitless: $other");
			}
			$this->value = substr($this->value, $other->value);
		}
		else {
			$this->value = str_replace($other->value, '', $this->value);
		}
		return $this;
	}

	/**
	 * Returns the value of this string.
	 * @return string the string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Returns a string representation of the value.
	 * @return string string representation of the value.
	 */
	public function toString() {
		return $this->value;
	}

	/**
	 * Returns a value indicating if a token of this type can be matched at
	 * the start of the subject string.
	 * @param string the subject string
	 * @return mixed match at the start of the string or false if no match
	 */
	static public function isa($subject) {
		return (preg_match(self::MATCH, $subject, $matches) ? $matches[0] : false);
	}
}