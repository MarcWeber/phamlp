<?php
/* SVN FILE: $Id$ */
/**
 * CDATA Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * CDATA Filter for {@link Haml http://haml-lang.com/} class.
 * Surrounds the filtered text with CDATA tags.
 * @package			Haml
 * @subpackage	filters
 */
class HamlCdataFilter extends HamlBaseFilter {
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
