<?php
/**
 * SassNode exception classes.
 *
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */

require_once(dirname(__FILE__).'/../SassException.php');

/**
 * SassNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassNodeException extends SassException {}

/**
 * SassContextException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassContextException extends SassNodeException {}
/**
 * SassCommentNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassCommentNodeException extends SassNodeException {}

/**
 * SassDirectiveNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassDirectiveNodeException extends SassNodeException {}

/**
 * SassForNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassForNodeException extends SassNodeException {}

/**
 * SassIfNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassIfNodeException extends SassNodeException {}

/**
 * SassImportNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassImportNodeException extends SassNodeException {}

/**
 * SassMixinDefinitionNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassMixinDefinitionNodeException extends SassNodeException {}

/**
 * SassMixinNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassMixinNodeException extends SassNodeException {}

/**
 * SassPropertyNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassPropertyNodeException extends SassNodeException {}

/**
 * SassRuleNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassRuleNodeException extends SassNodeException {}

/**
 * SassVariableNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassVariableNodeException extends SassNodeException {}

/**
 * SassWhileNodeException class.
 * @package sass
 * @author Chris Yates
 * @copyright Copyright &copy; 2010 PBM Web Development
 * @license http://phamlp.googlecode.com/files/license.txt
 */
class SassWhileNodeException extends SassNodeException {}