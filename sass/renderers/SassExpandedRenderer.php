<?php
/* SVN FILE: $Id$ */
/**
 * SassExpandedRenderer class file.
 * Rules are expanded with selectors and properties on single lines
 * and properties indented.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

/**
 * SassExpandedRenderer class.
 * @package sass
 * @author Chris Yates
 */
class SassExpandedRenderer extends SassRenderer {
	/**
	 * Renders the brace at the end of the rule
	 * @return string the brace between the rule and its properties
	 */
	protected function end() {
	  return "\n}\n";
	}

	/**
	 * Returns the indent string for the node
	 * @param SassNode the node to return the indent string for
	 * @return string the indent string for this SassNode
	 */
	protected function getIndent($node) {
		if ($node instanceof SassRuleNode || $node instanceof SassPropertyNode) {
			return ($node->inDirective() ? self::INDENT : '');
		}
		else {
			return '';
		}
	}

	/**
	 * Renders a comment.
	 * @param SassNode the node being rendered
	 * @return string the rendered commnt
	 */
	public function renderComment($node) {
		$comment = join("\n * ", $node->children);
	  return "/* $comment */";
	}

	/**
	 * Renders a property.
	 * @param SassNode the node being rendered
	 * @return string the rendered property
	 */
	public function renderProperty($node) {
		return self::INDENT . ($node->inDirective() ? self::INDENT : '') .
			parent::renderProperty($node);
	}
}