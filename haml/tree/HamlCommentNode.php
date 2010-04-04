<?php
/* SVN FILE: $Id$ */
/**
 * HamlNode class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright &copy; 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.tree
 */

/**
 * HamlNode class.
 * Base class for all Haml nodes.
 * @package			PHamlP
 * @subpackage	Haml.tree
 */
class HamlCommentNode extends HamlNode {
	private $isConditional;

	public function __construct($content) {
	  $this->content = $content;
		$this->isConditional = (bool)preg_match('/^\[.+\]$/', $content, $matches);
	}

	public function getIsConditional() {
		return $this->isConditional;
	}

	public function render() {
		$output  = $this->renderer->renderOpenComment($this);
		foreach ($this->children as $child) {
			$output .= $child->render();
		} // foreach
		$output .= $this->renderer->renderCloseComment($this);
	  return $this->debug($output);
	}
}