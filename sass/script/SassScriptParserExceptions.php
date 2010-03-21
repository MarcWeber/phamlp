<?php
/**
 * SassScript Parser exception class file.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */

require_once(dirname(__FILE__).'/../SassException.php');

/**
 * SassScriptParserException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassScriptParserException extends SassException {}

/**
 * SassScriptLexerException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassScriptLexerException extends SassScriptParserException {}

/**
 * SassScriptOperationException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassScriptOperationException extends SassScriptParserException {}

/**
 * SassScriptFunctionException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://www.yiiframework.com/license/
 */
class SassScriptFunctionException extends SassScriptParserException {}