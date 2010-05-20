<?php
/* SVN FILE: $Id$ */
/**
 * HamlHelpers class file.
 * 
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml
 */

/**
 * HamlHelpers class.
 * Contains various helpful methods to make it easier to do various tasks.
 * The class can be extended to provide user defined helper methods; the path to
 * the extended class is provided to HamlParser in the config array;
 * class name == file name.
 * 
 * HamlHelpers and any extended class are automatically included in the context
 * that a Haml template is parsed in, so all the methods are at your disposal
 * from within the template.
 * 
 * The signature for helper methods is ($block, $other, $arguments); $block is
 * the Haml block being operated on - it will be PHP by the the time the helper
 * sees it.
 * 
 * @package			PHamlP
 * @subpackage	Haml
 */
class HamlHelpers {
	/**
	 * Returns the block with string appended.
	 * @param string Haml block
	 * @param string string to append
	 * @return the block with string appended.
	 */
	public static function append($block, $string) {
	  return $block.$string;
	}
	
	/**
	 * Returns the block with string appended.
	 * @param string Haml block
	 * @param string string to append
	 * @return the block with string appended.
	 */
	public static function list_of($block, $items, $key, $value = null) {
		$output = '';
		foreach ($items as $_key=>$_value) {
			$output .= '<li>' . strtr($block, (empty($value) ? array($key=>$_value) : array($key=>$_key, $value=>$_value))) . '</li>';
		} // foreach
		return $output;
	}
	
	/**
	 * Alias for append.
	 * @see append
	 * @param string Haml block
	 * @param string string to prepend
	 * @return the block with string prepended
	 */
	public static function preceed($block, $string) {
		return self::prepend($block, $string);
	}
	
	/**
	 * Returns the block with string prepended.
	 * @param string Haml block
	 * @param string string to prepend
	 * @return the block with string prepended
	 */
	public static function prepend($block, $string) {
	  return $string.$block;
	}
	
	/**
	 * Alias for append.
	 * @see append
	 * @param string Haml block
	 * @param string string to apppend
	 * @return the block with string apppended
	 */
	public static function succeed($block, $string) {
		return self::append($block, $string);
	}
	
	/**
	 * Surrounds a block of Haml code with strings.
	 * If $back is not given it defaults to $front.
	 * @param string Haml block
	 * @param string string to prepend
	 * @param string string to apppend
	 * @return the block surrounded by the strings
	 */
	public static function surround($block, $front, $back=null) {
	  return $front.$block.(is_null($back) ? $front : $back);
	}	
}