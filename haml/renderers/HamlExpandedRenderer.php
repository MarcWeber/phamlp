<?php
/* SVN FILE: $Id$ */
/**
 * HamlExpandedRenderer class file.
 * Rules are expanded with selectors and properties on single lines
 * and properties indented.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

/**
 * HamlExpandedRenderer class.
 * @package sass
 * @author Chris Yates
 */
class HamlExpandedRenderer extends HamlRenderer {
	/**
	 * Renders the opening tag of an element
	 */
	public function renderOpeningTag($node) {
	  return parent::renderOpeningTag($node) .
	  	($node->whitespaceControl['inner'] ? '' :
	  	($node->isSelfClosing && $node->whitespaceControl['outer'] ? '' : "\n"));
	}

	/**
	 * Renders the closing tag of an element
	 */
	public function renderClosingTag($node) {
	  return ($node->isSelfClosing ? '' : parent::renderClosingTag($node) .
	  	($node->whitespaceControl['outer'] ? '' : "\n"));
	}

	/**
	 * Renders content.
	 * @param HamlNode the node being rendered
	 * @return string the rendered content
	 */
	public function renderContent($node) {
	  return self::INDENT . parent::renderContent($node) . "\n";
	}

	/**
	 * Renders the start of a code block
	 */
	public function renderStartCodeBlock($node) {
		return parent::renderStartCodeBlock($node) . "\n";
	}

	/**
	 * Renders the end of a code block
	 */
	public function renderEndCodeBlock($node) {
		return parent::renderEndCodeBlock($node) . "\n";
	}
}