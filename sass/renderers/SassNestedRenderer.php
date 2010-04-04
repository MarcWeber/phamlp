<?php
/* SVN FILE: $Id$ */
/**
 * SassNestedRenderer class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */

/**
 * SassNestedRenderer class.
 * Rules are expanded with selectors and properties on single lines.
 * Rules are indented according to their nesting level.
 * @package			PHamlP
 * @subpackage	Sass.renderers
 */
class SassNestedRenderer extends SassRenderer {
	/**
	 * Returns the indent string for the node
	 * @param SassNode the node being rendered
	 * @return string the indent string for this SassNode
	 */
	protected function getIndent($node) {
		$indentLevel = $node->indentLevel;

		if ($node instanceof SassPropertyNode && $node->inNamespace()) {
			$indentLevel--;
		}
		if ($node->inSassScriptDirective()) {
			$indentLevel--;
		}
		return str_repeat(self::INDENT, $indentLevel);
	}

	/**
	 * Renders a comment.
	 * @param SassNode the node being rendered
	 * @return string the rendered commnt
	 */
	public function renderComment($node) {
		$comment = join("\n" . $this->getIndent($node) . ' * ', $node->children);
	  return $this->getIndent($node) . "/* $comment */";
	}

	/**
	 * Renders a directive.
	 * @param SassNode the node being rendered
	 * @param array properties of the directive
	 * @return string the rendered directive
	 */
	public function renderDirective($node, $properties) {
		$directive = $this->getIndent($node) . $node->directive . $this->between() . $this->renderProperties($properties);
		return preg_replace('/(.*})\n$/', '\1', $directive) . $this->end();
	}

	/**
	 * Renders a property.
	 * @param SassNode the node being rendered
	 * @return string the rendered property
	 */
	public function renderProperty($node) {
		return $this->getIndent($node) . parent::renderProperty($node);
	}
}