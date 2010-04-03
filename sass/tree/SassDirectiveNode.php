<?php
/* SVN FILE: $Id$ */
/**
 * SassDirectiveNode class file.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

/**
 * SassDirectiveNode class.
 * Represents a CSS directive.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassDirectiveNode extends SassNode {
	const IDENTIFIER = '@';
	const MATCH = '/^(@\w+)/';

	/**
	 * @var string the directive
	 */
	private $directive;

	/**
	 * SassDirectiveNode.
	 * @param string string the directive
	 * @return SassDirectiveNode
	 */
	public function __construct($directive) {
		$this->directive = $directive;
	}

	/**
	 * Returns the directive
	 * @return string the directive
	 */
	public function getDirective() {
	  return $this->directive;
	}

	/**
	 * Parse this node.
	 * @param SassContext the context in which this node is parsed
	 * @return array the parsed node
	 */
	public function parse($context) {
		$children = array();
		foreach ($this->children as $child) {
			$children = array_merge($children, $child->parse($context));
		} // foreach
		$this->children = $children;
		return array($this);
	}

	/**
	 * Render this node.
	 * @return string the rendered node
	 */
	public function render() {
		$properties = array();
		foreach ($this->children as $child) {
			$properties[] = $child->render();
		} // foreach

		return $this->renderer->renderDirective($this, $properties);
	}

	/**
	 * Returns a value indicating if the line represents this type of node.
	 * @param array the line to test
	 * @return boolean true if the line represents this type of node, false if not
	 */
	static public function isa($line) {
		return $line['source'][0] === self::IDENTIFIER;
	}
}
