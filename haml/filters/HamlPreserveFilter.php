<?php
/* SVN FILE: $Id$ */
/**
 * Peserve Filter for {@link HAML http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * Peserve Filter for {@link HAML http://haml-lang.com/} class.
 * Does not parse the filtered text. This is useful for large blocks of text
 * without HTML tags when lines are not to be parsed.
 * @package			HAML
 * @subpackage	filters
 */
Class HamlPlainFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return str_replace("\n", '&#x000a',
	  	preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text)
	  ) . "\n";
	}
}