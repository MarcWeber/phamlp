<?php
/* SVN FILE: $Id$ */
/**
 * SassRenderer class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */			
/**
 * SassRenderer class.
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */
class SassRenderer {
	/**#@+
	 * Output Styles
	 */
	const STYLE_COMPRESSED = 'compressed';
	const STYLE_COMPACT 	 = 'compact';
	const STYLE_EXPANDED 	 = 'expanded';
	const STYLE_NESTED 		 = 'nested';
	/**#@-*/

	const INDENT = '  ';

	/**
	 * Returns the renderer for the required render style.
	 * @param string render style
	 * @return SassRenderer
	 */
	static public function getRenderer($style = null) {
		switch ($style) {
			case self::STYLE_COMPACT: 
				require_once('SassCompactRenderer.php');
		  	return new SassCompactRenderer();
			case self::STYLE_COMPRESSED:
				require_once('SassCompressedRenderer.php');
		  	return new SassCompressedRenderer();
			case self::STYLE_EXPANDED:
				require_once('SassExpandedRenderer.php');
		  	return new SassExpandedRenderer();
			case self::STYLE_NESTED:
				require_once('SassNestedRenderer.php');
		  	return new SassNestedRenderer();
		} // switch
	}
}