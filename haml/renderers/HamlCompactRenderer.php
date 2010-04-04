<?php
/* SVN FILE: $Id$ */
/**
 * HamlCompactRenderer class file.
 * Rules are on single lines.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.renderers
 */

/**
 * HamlCompactRenderer class.
 * @package			PHamlP
 * @subpackage	Haml.renderers
 */
class HamlCompactRenderer extends HamlRenderer {
	/**
	 * Renders the closing tag of an element
	 */
	public function renderClosingTag($node) {
	  return parent::renderClosingTag($node) . ($node->isBlock ? "\n" : '');
	}
}