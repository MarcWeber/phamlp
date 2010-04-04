<?php
/* SVN FILE: $Id$ */
/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} in  the 
 * {@link Yii PHP framework http://www.yiiframework.com/}
 * 
 * This file should be placed in the filterDir directory as defined in the
 * HamlParser options.
 * 
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright		Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Yii.filters
 */
 
Yii::import('ext.haml.vendors.phamlp.haml.filters._HamlMarkdownFilter');

/**
 * Markdown Filter for {@link Haml http://haml-lang.com/} class.
 * Parses the text with Markdown.
 * @package			PHamlP
 * @subpackage	Yii.filters
 */
class HamlMarkdownFilter extends _HamlMarkdownFilter {
	/**
	 * Initialise the filter with the $vendorClass
	 */	
	public function init() {
		$this->vendorClass='CMarkdownParser';
		parent::init();
	}
}