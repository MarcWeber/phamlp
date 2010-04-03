<?php
/* SVN FILE: $Id$ */
/**
 * Plain Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * Plain Filter for {@link Haml http://haml-lang.com/} class.
 * Does not parse the filtered text. This is useful for large blocks of text
 * without HTML tags when lines are not to be parsed.
 * @package			Haml
 * @subpackage	filters
 */
class HamlPlainFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text). "\n";
	}
}