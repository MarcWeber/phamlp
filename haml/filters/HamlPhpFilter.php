<?php
/* SVN FILE: $Id$ */
/**
 * PHP Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * PHP Filter for {@link Haml http://haml-lang.com/} class.
 * The text will be parsed with the PHP interpreter.
 * @package			Haml
 * @subpackage	filters
 */
class HamlPhpFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return "<?php\n$text?>\n";
	}
}