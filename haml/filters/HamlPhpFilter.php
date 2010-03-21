<?php
/* SVN FILE: $Id$ */
/**
 * PHP Filter for {@link HAML http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * PHP Filter for {@link HAML http://haml-lang.com/} class.
 * The text will be parsed with the PHP interpreter.
 * @package			HAML
 * @subpackage	filters
 */
Class HamlPhpFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return "<?php\n$text?>\n";
	}
}