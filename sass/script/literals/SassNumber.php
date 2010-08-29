<?php
/* SVN FILE: $Id$ */
/**
 * SassNumber class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.script.literals
 */

require_once('SassLiteral.php');
 
/**
 * SassNumber class.
 * Provides operations and type testing for Sass numbers.
 * Units are of the passed value are converted the those of the class value
 * if it has units. e.g. 2cm + 20mm = 4cm while 2 + 20mm = 22mm.
 * @package			PHamlP
 * @subpackage	Sass.script.literals
 */
class SassNumber extends SassLiteral {
	/**
	 * Regx for matching and extracting numbers
	 */
	const MATCH = '/^((?:-)?(?:\d*\.)?\d+)([a-zA-Z%]+)?/';
	const VALUE = 1;
	const UNITS = 2;
	/**
	 * The number of decimal digits to round to.
	 * If the units are pixels the result is always
	 * rounded down to the nearest integer.
	 */
	const PRECISION = 4;

	/**
	 * @var array allowable number units
	 */
	static private $cssUnits =
		array('%', 'em', 'ex', 'px', 'in', 'cm', 'mm', 'pt', 'pc');

	/**
	 * @var array Conversion factors for units using inches as the base unit
	 * (only because pt and px are expressed as fraction of an inch, so makes the
	 * numbers easy to understand).
	 * Conversions are based on the following
	 * in: inches — 1 inch = 2.54 centimeters
   * cm: centimeters
   * mm: millimeters
   * pc: picas — 1 pica = 12 points
   * pt: points — 1 point = 1/72nd of an inch
	 */
	static private $unitConversion = array(
		'in' => 1,
		'cm' => 2.54,
		'mm' => 25.4,
		'pc' => 6,
		'pt' => 72
	);

	/**
	 * @var string units of this number
	 */
	private $units = '';

	/**
	 * class constructor.
	 * Sets the value and units of the number.
	 * @param string number
	 * @return SassNumber
	 */
	public function __construct($value) {
	  preg_match(self::MATCH, $value, $matches);
	  $this->value = $matches[self::VALUE];
	  if (!empty($matches[self::UNITS])) {
	  	if (!in_array($matches[self::UNITS], self::$cssUnits)) {
				throw new SassNumberException('Invalid units: {value}', array('{value}'=>$value), SassScriptParser::$context->node);
	  	}
			$this->units = $matches[self::UNITS];
	  }
	}

	/**
	 * Adds the value of other to the value of this
	 * @param mixed SassNumber|SassColour: value to add
	 * @return mixed SassNumber if other is a SassNumber or
	 * SassColour if it is a SassColour
	 */
	public function op_plus($other) {
		if ($other instanceof SassColour) {
			return $other->plus($this);
		}
		else {
			$other = $this->convertUnits($other);
			$this->value += $other->value;
			return $this;
		}
	}

	/**
	 * Unary + operator
	 * @return SassNumber the value of this number
	 */
	public function op_unary_plus() {
		return $this;
	}

	/**
	 * Subtracts the value of other from this value
	 * @param mixed SassNumber|SassColour: value to subtract
	 * @return mixed SassNumber if other is a SassNumber or
	 * SassColour if it is a SassColour
	 */
	public function op_minus($other) {
		if ($other instanceof SassColour) {
			return $other->minus($this);
		}
		else {
			$other = $this->convertUnits($other);
			$this->value -= $other->value;
			return $this;
		}
	}

	/**
	 * Unary - operator
	 * @return SassNumber the negative value of this number
	 */
	public function op_unary_minus() {
		return new SassNumber(($this->value * -1).$this->units);
	}

	/**
	 * Multiplies this value by the value of other
	 * @param mixed SassNumber|SassColour: value to multiply by
	 * @return mixed SassNumber if other is a SassNumber or
	 * SassColour if it is a SassColour
	 */
	public function op_times($other) {
		if ($other instanceof SassColour) {
			return $other->times($this);
		}
		else {
			$other = $this->convertUnits($other);
			$this->value *= $other->value;
			return $this;
		}
	}

	/**
	 * Divides this value by the value of other
	 * @param mixed SassNumber|SassColour: value to divide by
	 * @return mixed SassNumber if other is a SassNumber or
	 * SassColour if it is a SassColour
	 */
	public function op_divide_by($other) {
		if ($other instanceof SassColour) {
			return $other->divide_by($this);
		}
		else {
			$other = $this->convertUnits($other);
			$this->value /= $other->value;
			return $this;
		}
	}
	/**
	 * The SassScript == operation.
	 * @return SassBoolean SassBoolean object with the value true if the values
	 * of this and other are equal, false if they are not
	 */
	public function op_eq($other) {
		$other = $this->convertUnits($other);
		return new SassBoolean(($this->value == $other->value ? 'true' : 'false'));
	}
	/**
	 * The SassScript != operation.
	 * @return SassBoolean SassBoolean object with the value true if the values
	 * of this and other are not equal, false if they are
	 */
	public function op_neq($other) {
		$other = $this->convertUnits($other);
		return new SassBoolean(($this->value != $other->value ? 'true' : 'false'));
	}

	/**
	 * Takes the modulus (remainder) of this value divided by the value of other
	 * @param string value to divide by
	 * @return mixed SassNumber if other is a SassNumber or
	 * SassColour if it is a SassColour
	 */
	public function op_modulo($other) {
		if ($other instanceof SassColour) {
			return $other->modulo($this);
		}
		else {
			$other = $this->convertUnits($other);
			$this->value %= $other->value;
			return $this;
		}
	}

	/**
	 * Converts the other number to this numbers units.
	 * @param SassNumber the other number
	 * @return SassNumber the other number with converted to this numbers units
	 * @throws SassNumberException if the units are incompatible
	 */
	private function convertUnits($other) {
		if ($other->hasUnits()) {
		  if (!$this->hasUnits()) {
				$this->units = $other->units;
		  }
			elseif ($other->units != $this->units) {
				if (array_key_exists($this->units, self::$unitConversion) &&
						array_key_exists($other->units, self::$unitConversion)) {
					$other->value *=
						(self::$unitConversion[$this->units] /
						 self::$unitConversion[$other->units]);
					$other->units = $this->units;
				}
				else {
					throw new SassNumberException('Incompatible units: {value1} and {value2}', array('{value1}'=>$this->units, '{value2}'=>$this->units), SassScriptParser::$context->node);
				}
			}
		}
		return $other;
	}

	/**
	 * Returns a value indicating if this number has units.
	 * @return boolean true if this number has units, false if not
	 */
	public function hasUnits() {
	  return !empty($this->units);
	}

	/**
	 * Returns the units of this number.
	 * @return string the units of this number
	 */
	public function getUnits() {
	  return $this->units;
	}

	/**
	 * Returns a value indicating if this number is an integer.
	 * @return boolean true if this number is an integer, false if not
	 */
	public function isInt() {
	  return $this->value % 1 == 0;
	}

	/**
	 * Returns the value of this number.
	 * @return mixed float if a unitless number, otherwise string
	 */
	public function getValue() {
		return $this->hasUnits() ? $this->toString() : $this->value;
	}

	/**
	 * Converts the number to a string with it's units if any.
	 * If the units are px the result is rounded down to the nearest integer,
	 * otherwise the result is rounded to the specified precision.
 	 * @return string number as a string with it's units if any
	 */
	public function toString() {
	  return ($this->units == 'px' ? floor($this->value) :
	  		round($this->value, self::PRECISION)).$this->units;
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