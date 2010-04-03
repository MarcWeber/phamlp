<?php
/* SVN FILE: $Id$ */
/**
 * Base Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * Base Filter for {@link Haml http://haml-lang.com/} class.
 * This class must be extended and the filter method overridden.
 * @package			Haml
 * @subpackage	filters
 */
abstract class HamlBaseFilter {
	/**
	 * Initialise the filter.
	 */
	public function init() {}

	/**
	 * Run the filter.
	 * This method must be overridden in child classes.
	 * @param string text to filter
	 */
	abstract public function run($text);
}