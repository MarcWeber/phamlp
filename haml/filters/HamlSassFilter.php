<?php
/* SVN FILE: $Id$ */
/**
 * {@link Sass http://sass-lang.com/} Filter for
 * {@link Haml http://haml-lang.com/} class file.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

require_once('HamlCssFilter.php');
require_once(dirname(__FILE__).'/../../sass/SassParser.php');

/**
 * {@link Sass http://sass-lang.com/} Filter for
 * {@link Haml http://haml-lang.com/} class.
 * Parses the text as Sass then calls the CSS filter.
 * Useful for including inline Sass.
 * @package			Haml
 * @subpackage	filters
 */
class HamlSassFilter extends HamlBaseFilter {
	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
		$sass = new SassParser();
		$css = new HamlCssFilter();
		$css->init();

		return $css->run($sass->toCss(preg_replace(HamlParser::MATCH_INTERPOLATION, '<?php echo \1; ?>', $text), false));
	}
}