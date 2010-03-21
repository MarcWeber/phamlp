<?php
/* SVN FILE: $Id$ */
/**
 * Escaped Filter for {@link HAML http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * Escaped Filter for {@link HAML http://haml-lang.com/} class.
 * Escapes the text.
 * Code to be interpolated can be included by wrapping it in #().
 * @package			HAML
 * @subpackage	filters
 */
Class HamlEscapedFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
	  return preg_replace(
	  	HamlParser::MATCH_INTERPOLATION,
	  	'<?php echo htmlspecialchars($text); ?>',
	  	htmlspecialchars($text)
	  ) . "\n";
	}
}