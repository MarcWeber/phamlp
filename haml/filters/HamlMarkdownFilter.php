<?php
/* SVN FILE: $Id$ */
/**
 * Markdown Filter for {@link HAML http://haml-lang.com/} class file.
 *
 * This filter is written for the {@link Yii PHP framework http://www.yiiframework.com/}
 * and will need to be modifed for use with other frameworks and applications.
 * @author			Chris Yates
 * @copyright		Copyright &copy; 2009 PBM Web Development
 * @license			http://www.yiiframework.com/license/
 * @package			HAML
 * @subpackage	filters
 */

/**
 * Markdown Filter for {@link HAML http://haml-lang.com/} class.
 * Parses the text with Markdown.
 * @package			HAML
 * @subpackage	filters
 */
Class HamlMarkdownFilter extends HamlBaseFilter {
	/**
	 * Initialise the filter
	 */
	public function init() {
		parent::init();
	}

	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
		return '<?php	if (empty($markdown___))$markdown___ = new CMarkdownParser();echo $markdown___->safeTransform("'.preg_replace(HamlParser::MATCH_INTERPOLATION, '".\1."', $text).'");?>';
	}
}