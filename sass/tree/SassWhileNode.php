<?php
/* SVN FILE: $Id$ */
/**
 * SassWhileNode class file.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

/**
 * SassWhileNode class.
 * Represents a Sass @while loop and a Sass @do loop.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassWhileNode extends SassNode {
	const MATCH = '/^@(do|while)\s+(.+)$/';
	const LOOP = 1;
	const EXPRESSION = 2;
	const IS_DO = 'do';
	/**
	 * @var boolean whether this is a do/while.
	 * A do/while loop is guarenteed to run at least once.
	 */
	private $isDo;
	/**
	 * @var string expression to evaluate
	 */
	private $expression;

	/**
	 * SassWhileNode constructor.
	 * @param string expression to evaluate
	 * @param boolean whether this is a "do" or "while" loop.
	 * True for a "do" loop, false for a "while" loop
	 * @return SassWhileNode
	 */
	public function __construct($expression, $isDo = false) {
		$this->expression = $expression;
		$this->isDo = $isDo;
	}

	/**
	 * Parse this node.
	 * @param SassContext the context in which this node is parsed
	 * @return array the parsed child nodes
	 */
	public function parse($context) {
		$children = array();
		if ($this->isDo) {
			do {
				foreach ($this->children as $child) {
					$children = array_merge($children, $child->parse($context));
				} // foreach
			} while ($this->evaluate($this->expression, $context));
		}
		else {
			while ($this->evaluate($this->expression, $context)) {
				foreach ($this->children as $child) {
					$children = array_merge($children, $child->parse($context));
				} // foreach
			}
		}
		return $children;
	}

	/**
	 * Returns the matches for this type of node.
	 * @param array the line to match
	 * @return array matches
	 */
	static public function match($line) {
		preg_match(self::MATCH, $line['source'], $matches);
		return $matches;
	}
}