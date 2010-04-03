<?php
/**
 * SassScript Parser exception class file.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

require_once(dirname(__FILE__).'/../SassException.php');

/**
 * SassScriptParserException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassScriptParserException extends SassException {}

/**
 * SassScriptLexerException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassScriptLexerException extends SassScriptParserException {}

/**
 * SassScriptOperationException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassScriptOperationException extends SassScriptParserException {}

/**
 * SassScriptFunctionException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassScriptFunctionException extends SassScriptParserException {}