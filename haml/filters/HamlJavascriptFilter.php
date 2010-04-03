<?php
/* SVN FILE: $Id$ */
/**
 * Javascript Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * Javascript Filter for {@link Haml http://haml-lang.com/} class.
 * Surrounds the filtered text with <script> and CDATA tags.
 * Useful for including inline Javascript.
 * Code to be interpolated can be included by wrapping it in #().
 * @package			Haml
 * @subpackage	filters
 */
class HamlJavascriptFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return "<script type=\"text/javascript\">\n  //<![CDATA[\n" .
	  	preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text) .
	  	"  //]]>\n</script>\n";
	}
}