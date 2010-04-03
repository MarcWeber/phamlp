<?php
/* SVN FILE: $Id$ */
/**
 * CSS Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * CSS Filter for {@link Haml http://haml-lang.com/} class.
 * Surrounds the filtered text with <style> and CDATA tags.
 * Useful for including inline CSS.
 * @package			Haml
 * @subpackage	filters
 */
class HamlCssFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return "<style type=\"text/css\">\n<![CDATA[\n" .
	  	preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text) .
	  	"]]>\n</style>\n";
	}
}