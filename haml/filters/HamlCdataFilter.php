<?php
/* SVN FILE: $Id$ */
/**
 * CDATA Filter for {@link HAML http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * CDATA Filter for {@link HAML http://haml-lang.com/} class.
 * Surrounds the filtered text with CDATA tags.
 * @package			HAML
 * @subpackage	filters
 */
Class HamlCdataFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return "<![CDATA[\n" .
	  	preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text) .
	  	"  ]]>\n";
	}
}