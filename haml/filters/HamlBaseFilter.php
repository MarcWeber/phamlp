<?php
/* SVN FILE: $Id$ */
/**
 * Base Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.filters
 */

/**
 * Base Filter for {@link Haml http://haml-lang.com/} class.
 * This class must be extended and the filter method overridden.
 * @package			PHamlP
 * @subpackage	Haml.filters
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