<?php
/**
 * Sass literal exception classes.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

require_once(dirname(__FILE__).'/../SassScriptParserExceptions.php');

/**
 * Sass literal exception.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassLiteralException extends SassScriptParserException {}

/**
 * SassBooleanException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassBooleanException extends SassLiteralException {}

/**
 * SassColourException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassColourException extends SassLiteralException {}

/**
 * SassNumberException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassNumberException extends SassLiteralException {}

/**
 * SassStringException class.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassStringException extends SassLiteralException {}