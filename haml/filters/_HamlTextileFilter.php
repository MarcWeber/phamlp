<?php
/* SVN FILE: $Id$ */
/**
 * Textile Filter for {@link Haml http://haml-lang.com/} class file.
 * 
 * This class must be extended and the getParser() method implemented. 
 * 
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * Textile Filter for {@link Haml http://haml-lang.com/} class.
 * Parses the text with Textile.
 * @package			Haml
 * @subpackage	filters
 */
abstract class _HamlTextileFilter extends HamlBaseFilter {
	/**
	 * @var Textile Textile Parser
	 */
	public $textile;
	
	/**
	 * Initialise the filter
	 */
	public function init() {
		self::$textile = $this->getParser();
		parent::init();
	}

	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
		return '<?php	echo HamlTextileFilter::$textile->TextileThis("'.preg_replace(HamlParser::MATCH_INTERPOLATION, '".\1."', $text).'");?>';
	}

	/**
	 * Returns the parser.
	 */
	 abstract protected function getParser();	
}