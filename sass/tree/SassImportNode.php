<?php
/* SVN FILE: $Id$ */
/**
 * SassImportNode class file.
 * @author			Chris Yates <chris.l.yates@gmail.com>
 * @copyright 	Copyright (c) 2010 PBM Web Development
 * @license			http://phamlp.googlecode.com/files/license.txt
 * @package			PHamlP
 * @subpackage	Sass.tree
 */

/**
 * SassImportNode class.
 * Represents a CSS Import.
 * @package			PHamlP
 * @subpackage	Sass.tree
 */
class SassImportNode extends SassNode {
	const IDENTIFIER = '@';
	const MATCH = '/^@import\s+(.+)/i';
	const MATCH_CSS = '/^(url\(|")/i';
	const URI = 1;

	/**
	 * @var string uri to import
	 */
	private $uri;

	/**
	 * SassImportNode.
	 * @param object source token
	 * @return SassImportNode
	 */
	public function __construct($token) {
		parent::__construct($token);
		preg_match(self::MATCH, $token->source, $matches);
		$this->uri = $matches[self::URI];
	}

	/**
	 * Parse this node.
	 * If a CSS import returns the import rule.
	 * Else returns the rendered tree for the file.
	 * @param SassContext the context in which this node is parsed
	 * @return array the parsed node
	 */
	public function parse($context) {
		if (preg_match(self::MATCH_CSS, $this->uri)) {
			return "@import {$this->uri}";
		}
		else {
			$tree = SassFile::getTree(
				SassFile::getFile($this->uri, $this->parser), $this->parser);
			if (empty($tree)) {
				throw new SassImportNodeException('Unable to create document tree for {uri}', array('{uri}'=>$this->uri), $this);
			}
			else {
				return $tree->parse($context)->children;
			}
		}
	}
}