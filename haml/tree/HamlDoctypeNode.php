<?php
/* SVN FILE: $Id$ */
/**
 * HamlDoctypeNode class file.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

/**
 * HamlDoctypeNode class.
 * Represents a Doctype.
 * Doctypes are always rendered on a single line with a newline.
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class HamlDoctypeNode extends HamlNode {
	/**
	 * Render this node.
	 * @return string the rendered node
	 */
	public function render() {
		return $this->debug($this->content . "\n");
	}
}