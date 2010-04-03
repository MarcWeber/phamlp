<?php
/* SVN FILE: $Id$ */
/**
 * SassCompressedRenderer class file.
 * Output is on one line with minimal whitespace.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

/**
 * SassCompressedRenderer class.
 * @package sass
 * @author Chris Yates
 */
class SassCompressedRenderer extends SassRenderer {
	/**
	 * Renders the brace between the selectors and the properties
	 * @return string the brace between the selectors and the properties
	 */
	protected function between() {
	  return '{';
	}

	/**
	 * Renders the brace at the end of the rule
	 * @return string the brace between the rule and its properties
	 */
	protected function end() {
	  return '}';
	}

	/**
	 * Renders the rule's selectors
	 * @param SassNode the node being rendered
	 * @return string the rendered selectors
	 */
	protected function renderSelectors($node) {
		$selectors = '';
		foreach ($node->selectors as $line) {
			$selectors .= $this->getIndent($node) . join(',', $line) . ",";
		} // foreach
	  return substr($selectors, 0, -1);
	}

	/**
	 * Renders properties.
	 * @param array properties to render
	 * @return string the rendered properties
	 */
	public function renderProperties($properties) {
		return join('', $properties);
	}

	/**
	 * Renders a property.
	 * @param SassNode the node being rendered
	 * @return string the rendered property
	 */
	public function renderProperty($node) {
		return "{$node->name}:{$node->value};";
	}
}
