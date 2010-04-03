<?php
/* SVN FILE: $Id$ */
/**
 * HamlNode class file.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

require_once('HamlRootNode.php');
require_once('HamlNodeExceptions.php');

/**
 * HamlNode class.
 * Base class for all Haml nodes.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class HamlElementNode extends HamlNode {
	public $isBlock;
	public $isSelfClosing;
	public $attributes;
	public $whitespaceControl;
	public $escapeHTML;

	public function render() {
		if ($this->whitespaceControl['outer']) {
			$this->parent->output = preg_replace('/(?-m)(?s)(.+?)\s*$/', '\1', $this->parent->output);
		}

		$output = '';
		foreach ($this->children as $child) {
			$output .= $child->render();
		} // foreach

	  return $this->debug($this->renderer->renderOpeningTag($this) .
			($this->whitespaceControl['inner'] ?
				preg_replace('/(?-m)(?s)^\s*(.+?)\s*$/', '\1', $output) : $output) .
			$this->renderer->renderClosingTag($this));
	}
}