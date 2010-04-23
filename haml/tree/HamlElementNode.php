<?php
/* SVN FILE: $Id$ */
/**
 * HamlElementNode class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Haml.tree
 */

require_once('HamlRootNode.php');
require_once('HamlNodeExceptions.php');

/**
 * HamlElementNode class.
 * Represents an element.
 * @package			PHamlP
 * @subpackage	Haml.tree
 */
class HamlElementNode extends HamlNode {
	const STRIP_PRECEEDING_WHITESPACE = '/(?-m)(?s)\s*(.+?)$/';
	const STRIP_SURROUNDING_WHITESPACE = '/(?-m)(?s)^\s*(.+?)\s*$/';
	const STRIP_TRAILING_WHITESPACE = '/(?-m)(?s)(.+?)\s*$/';

	public $isBlock;
	public $isSelfClosing;
	public $attributes;
	public $whitespaceControl;
	public $escapeHTML;

	public function render() {
		$renderer = $this->renderer;
		$this->output = $renderer->renderOpeningTag($this);
		$close = $renderer->renderClosingTag($this);
		
		if ($this->whitespaceControl['outer']) {
			$this->output =
				preg_replace(self::STRIP_PRECEEDING_WHITESPACE, '\1', $this->output);
			$close = preg_replace(self::STRIP_TRAILING_WHITESPACE, '\1', $close);
			$this->parent->output =
				preg_replace(self::STRIP_TRAILING_WHITESPACE, '\1', $this->parent->output);
		}

		foreach ($this->children as $child) {
			$output = $child->render();
			$this->output .= ($this->whitespaceControl['inner'] ?
				preg_replace(self::STRIP_SURROUNDING_WHITESPACE, '\1', $output) :
				$output);
		} // foreach

		return $this->debug($this->output .	(isset($child) &&
			$child instanceof HamlElementNode &&
			$child->whitespaceControl['outer'] ?
			preg_replace(self::STRIP_PRECEEDING_WHITESPACE, '\1', $close) : $close));
	}
}