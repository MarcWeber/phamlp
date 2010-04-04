<?php
/* SVN FILE: $Id$ */
/**
 * HamlCompactRenderer class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.renderers
 */

/**
 * HamlCompactRenderer class.
 * Renders blocks on single lines.
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