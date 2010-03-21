<?php
/* SVN FILE: $Id$ */
/**
 * SassRenderer class file.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

require_once('SassCompactRenderer.php');
require_once('SassCompressedRenderer.php');
require_once('SassExpandedRenderer.php');
require_once('SassNestedRenderer.php');

/**
 * SassRenderer class.
 * Provides the most common version of each method. Child classs override
 * methods to provide style specific rendering.
 * @package sass
 * @author Chris Yates
 */
class SassRenderer {
	/**#@+
	 * Output Styles
	 */
	const STYLE_COMPRESSED = 'compressed';
	const STYLE_COMPACT 	 = 'compact';
	const STYLE_EXPANDED 	 = 'expanded';
	const STYLE_NESTED 		 = 'nested';
	/**#@-*/

	const INDENT = '  ';

	/**
	 * Returns the renderer for the required render style.
	 * @param string render style
	 * @return SassRenderer
	 */
	static public function getRenderer($style = null) {
		switch ($style) {
			case self::STYLE_COMPACT:
		  	return new SassCompactRenderer();
			case self::STYLE_COMPRESSED:
		  	return new SassCompressedRenderer();
			case self::STYLE_EXPANDED:
		  	return new SassExpandedRenderer();
			case self::STYLE_NESTED:
		  	return new SassNestedRenderer();
		} // switch
	}

	/**
	 * Returns the indent string for the node
	 * @param SassNode the node to return the indent string for
	 * @return string the indent string for this SassNode
	 */
	protected function getIndent($node) {
	  return '';
	}

	/**
	 * Renders the brace between the selectors and the properties
	 * @return string the brace between the selectors and the properties
	 */
	protected function between() {
	  return " {\n";
	}

	/**
	 * Renders the brace at the end of the rule
	 * @return string the brace between the rule and its properties
	 */
	protected function end() {
	  return " }\n";
	}

	/**
	 * Renders a comment.
	 * @param SassNode the node being rendered
	 * @return string the rendered comment
	 */
	public function renderComment($node) {
	  return '';
	}

	/**
	 * Renders a directive.
	 * @param SassNode the node being rendered
	 * @param array properties of the directive
	 * @return string the rendered directive
	 */
	public function renderDirective($node, $properties) {
		return $this->getIndent($node) . $node->directive . $this->between() . $this->renderProperties($properties) . $this->end();
	}

	/**
	 * Renders properties.
	 * @param array properties to render
	 * @return string the rendered properties
	 */
	public function renderProperties($properties) {
		return join("\n", $properties);
	}

	/**
	 * Renders a property.
	 * @param SassNode the node being rendered
	 * @return string the rendered property
	 */
	public function renderProperty($node) {
		return "{$node->name}: {$node->value};";
	}

	/**
	 * Renders a rule.
	 * @param SassNode the node being rendered
	 * @param array rule properties
	 * @param string rendered rules
	 * @return string the rendered directive
	 */
	public function renderRule($node, $properties, $rules) {
		return (!empty($properties) ? $this->renderSelectors($node) . $this->between() . $this->renderProperties($properties) . $this->end() : '') . $rules;
	}

	/**
	 * Renders rule selectors.
	 * @param SassNode the node being rendered
	 * @return string the rendered selectors
	 */
	protected function renderSelectors($node) {
		$selectors = '';
		foreach ($node->selectors as $line) {
			$selectors .= $this->getIndent($node) . join(', ', $line) . ",\n";
		} // foreach
	  return substr($selectors, 0, -2);
	}
}