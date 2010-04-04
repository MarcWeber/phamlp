<?php
/* SVN FILE: $Id$ */
/**
 * HamlCompressedRenderer class file.
 * Output is on one line with minimal whitespace.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.renderers
 */

/**
 * HamlCompressedRenderer class.
 * @package			PHamlP
 * @subpackage	Haml.renderers
 */
class HamlCompressedRenderer extends HamlRenderer {
	/**
	 * Renders the opening of a comment.
	 * Only conditional comments are rendered
	 */
	public function renderOpenComment($node) {
		if ($node->isConditional) return parent::renderOpenComment($node);
	}

	/**
	 * Renders the closing of a comment.
	 * Only conditional comments are rendered
	 */
	public function renderCloseComment($node) {
		if ($node->isConditional) return parent::renderCloseComment($node);
	}
}