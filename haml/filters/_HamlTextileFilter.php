<?php
/* SVN FILE: $Id$ */
/**
 * Textile Filter for {@link Haml http://haml-lang.com/} class file.
 * 
 * This class must be extended and the getParser() method implemented. 
 * 
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.filters
 */

/**
 * Textile Filter for {@link Haml http://haml-lang.com/} class.
 * Parses the text with Textile.
 * @package			PHamlP
 * @subpackage	Haml.filters
 */
abstract class _HamlTextileFilter extends HamlBaseFilter {
	/**
	 * @var string Path to Textile Parser
	 */
	protected $vendorPath;
	/**
	 * @var string Textile class
	 * Override this value if the class name is different in your environment
	 */
	protected $vendorClass = 'Textile';
	
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