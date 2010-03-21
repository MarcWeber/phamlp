<?php
/* SVN FILE: $Id$ */
/**
 * HamlNestedRenderer class file.
 * Rules are expanded with selectors and properties on single lines.
 * Rules are indented according to their nesting level.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

/**
 * HamlNestedRenderer class.
 * @package sass
 * @author Chris Yates
 */
class HamlNestedRenderer extends HamlRenderer {
	/**
	 * Renders the opening tag of an element
	 */
	public function renderOpeningTag($node) {
	  return $this->getIndent($node) . parent::renderOpeningTag($node) .
	  	($node->whitespaceControl['inner'] ? '' :
	  	($node->isSelfClosing && $node->whitespaceControl['outer'] ? '' : "\n"));
	}

	/**
	 * Renders the closing tag of an element
	 */
	public function renderClosingTag($node) {
	  return ($node->isSelfClosing ? '' : $this->getIndent($node) .
	  	parent::renderClosingTag($node) .
	  	($node->whitespaceControl['outer'] ? '' : "\n"));
	}

	/**
	 * Renders content.
	 * @param HamlNode the node being rendered
	 * @return string the rendered content
	 */
	public function renderContent($node) {
	  return $this->getIndent($node) . parent::renderContent($node) . "\n";
	}

	/**
	 * Renders the opening of a comment
	 */
	public function renderOpenComment($node) {
		return parent::renderOpenComment($node) . (empty($node->content) ? "\n" : '');
	}

	/**
	 * Renders the closing of a comment
	 */
	public function renderCloseComment($node) {
		return parent::renderCloseComment($node) . "\n";
	}

	/**
	 * Renders the start of a code block
	 */
	public function renderStartCodeBlock($node) {
		return $this->getIndent($node) . parent::renderStartCodeBlock($node) . "\n";
	}

	/**
	 * Renders the end of a code block
	 */
	public function renderEndCodeBlock($node) {
		return $this->getIndent($node) . parent::renderEndCodeBlock($node) . "\n";
	}

	private function getIndent($node) {
	  return str_repeat(' ', 2 * $node->line['indentLevel']);
	}
}