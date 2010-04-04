<?php
/* SVN FILE: $Id$ */
/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} class file.
 *
 * This filter is an abstract filter that must be extended to provide
 * the get Parser method.
 * 
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.filters
 */

/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} class.
 * Parses the text with Markdown.
 * @package			PHamlP
 * @subpackage	Haml.filters
 */
abstract class _HamlMarkdownFilter extends HamlBaseFilter {
	/**
	 * @var string Path to Markdown Parser
	 */
	protected $vendorPath;
	/**
	 * @var string Markdown class
	 * Override this value if the class name is different in your environment
	 */
	protected $vendorClass = 'Markdown_Parser';
	
	/**
	 * Child classes must implement this method.
	 * Typically the child class will set $vendorPath and $vendorClass
	 */
	public function init() {}

	/**
	 * Run the filter
	 * @param string text to filter
	 * @return string filtered text
	 */
	public function run($text) {
		return '<?php	'.(!empty($this->vendorPath)?'require_once "'.$this->vendorPath.'";':'').'$markdown___=new '.$this->vendorClass.'();echo  $markdown___->safeTransform("'.preg_replace(HamlParser::MATCH_INTERPOLATION, '".\1."', $text).'");?>';
	}
}