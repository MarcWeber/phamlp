<?php
/* SVN FILE: $Id$ */
/**
 * Base Filter for {@link HAML http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * Base Filter for {@link HAML http://haml-lang.com/} class.
 * This class must be extended and the filter method overridden.
 * @package			HAML
 * @subpackage	filters
 */
abstract class HamlBaseFilter {
	/**
	 * @var integer the indent level at which the filter was loaded
	 */
	public $indentLevel;

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