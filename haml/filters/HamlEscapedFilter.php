<?php
/* SVN FILE: $Id$ */
/**
 * Escaped Filter for {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.filters
 */

/**
 * Escaped Filter for {@link Haml http://haml-lang.com/} class.
 * Escapes the text.
 * Code to be interpolated can be included by wrapping it in #().
 * @package			PHamlP
 * @subpackage	Haml.filters
 */
class HamlEscapedFilter extends HamlBaseFilter {
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
