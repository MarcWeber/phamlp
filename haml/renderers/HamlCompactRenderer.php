<?php
/* SVN FILE: $Id$ */
/**
 * HamlCompactRenderer class file.
 * Rules are on single lines.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

/**
 * HamlCompactRenderer class.
 * @package sass
 * @author Chris Yates
 */
class HamlCompactRenderer extends HamlRenderer {
	/**
	 * Renders the closing tag of an element
	 */
	public function renderClosingTag($node) {
	  return parent::renderClosingTag($node) . ($node->isBlock ? "\n" : '');
	}
}