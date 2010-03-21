<?php
/* SVN FILE: $Id$ */
/**
 * Sass class file.
 * Parses {@link SASS http://sass-lang.com/} files.
 * Please see the {@link SASS documentation http://sass-lang.com/docs} for
 * details of SASS.
 *
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

 // Do NOT use Yii::import. Doing so causes conflict with HamlSassFilter
require_once(Yii::getPathOfAlias('application.vendors.haml.sass').DIRECTORY_SEPARATOR.'SassParser.php');

/**
 * Sass class
 * @author Chris Yates
 * @package extensions.haml
 * @subpackage sass
 */
class Sass {
	/**
	 * @var SassParser
	 */
	private $sass;

	/**
	 * Constructor
	 * @param array SASS options
	 * @return Sass
	 */
	public function __construct($options) {
	  $this->sass = new SassParser($options);
	}

	/**
	 * Parse a SASS file to CSS
	 * @param string path to file
	 * @return string CSS
	 */
	public function parse($file) {
	  return $this->sass->toCss($file);
	}
}