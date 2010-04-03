<?php
/* SVN FILE: $Id$ */
/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} class file.
 *
 * This filter is an abstract filter that must be extended to provide
 * the get Parser method.
 * 
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			Haml
 * @subpackage	filters
 */

/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} class.
 * Parses the text with Markdown.
 * @package			Haml
 * @subpackage	filters
 */
abstract class _HamlMarkdownFilter extends HamlBaseFilter {
	/**
	 * @var Markdown_Parser Markdown Parser
	 */
	static public $markdown;

	/**
	 * Initialise the filter
	 */
	public function init() {
		self::$markdown = $this->getParser();
		parent::init();
	}

	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
		return '<?php	echo HamlMarkdownFilter::$markdown->safeTransform("'.preg_replace(HamlParser::MATCH_INTERPOLATION, '".\1."', $text).'");?>';
	}

	/**
	 * Returns the parser.
	 */
	 abstract protected function getParser();
}