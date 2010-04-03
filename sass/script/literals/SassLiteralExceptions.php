<?php
/**
 * Sass literal exception classes.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

require_once(dirname(__FILE__).'/../SassScriptParserExceptions.php');

/**
 * Sass literal exception.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassLiteralException extends SassScriptParserException {}

/**
 * SassBooleanException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassBooleanException extends SassLiteralException {}

/**
 * SassColourException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassColourException extends SassLiteralException {}

/**
 * SassNumberException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassNumberException extends SassLiteralException {}

/**
 * SassStringException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassStringException extends SassLiteralException {}