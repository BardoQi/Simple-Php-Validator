<?php

/**
 * This file is part of Bulo framework.
 *
 * Bulo -- Bulo library enterprise extension
 *
 * An open source  framework for PHP 5.4.0 or newer
 *
 * @copyright  Copyright (c)  2010 Bardo QI
 * @author     Bardo QI
 * @link       http://www.Bulo.org
 * @license    http://www.Bulo.org/license.html
 * @version    1.0
 * @package    Cache
 * @since        Version 1.0
 * @filesource
 */

namespace Bulo\Library\Validator;

use Bulo\Library\Validator\ValidatorRule;
use Bulo\Library\Validator\VlidatorErrorCode;

/**
 * Validation Class
 * 
 *
 * @package        Bulo
 * @subpackage    core
 * @category    Validator
 * @author        Bulo Dev Team: Bardo QI
 * @link
 */
class Validator extends stdClass
{
    /**
     * array of rules
     * 
     *
     * @access public
     * @var array
     */
    public static $rules;

    public static $validators;


    /**
     * Validator::__construct()
     * 
     * @param mixed $rulesFile
     * @param mixed $validatorFile
     * @return void
     */
    public function __construct( $rulesFile = null, $validatorFile = null )
    {
        if ($rulesFile != null){
            $this->addRules( $rulesFile );
        }
        if ($validatorFile != null){
            $this->addValidators( $validatorFile );
        }        
    }

    /**
     * Validator::add()
     *
     * 
     *
     * @param mixed $typeName
     * @param mixed $object: closure or Rule class implements RuleInterface
     * @return
     */
    public static function add( $typeName, $object )
    {
        self::$validators[$typeName] = $object;
    }

    /**
     * Validator::addRules()
     * 
     * @param mixed $rulesFile
     * @return void
     */
    public function addRules( $rulesFile )
    {
        $rules = require_once ( $rulesFile );
        if ( is_array( self::$rules ) )
            self::$rules = array_merge( self::$rules, $rules );
        else    
            self::$rules = $rules;
    }

    /**
     * Validator::addValidators()
     * 
     * @param mixed $validatorsFile
     * @return void
     */
    public function addValidators( $validatorsFile )
    {
        require_once ( $validatorsFile );
    }

    /**
     * Validator::validat()
     * validate the value
     * 
     *
     * @access public
     * @param string $value
     * @param string $type
     * @param mixed $params
     * @return boolean
     */
    public function validat( $value, $type, $params = null )
    {
        $ret = true;
        if ( isset( self::$rules[$type] ) )
            $ret = $this->_regex( $value, $type );
        else
        {
            if ( is_callable( self::$validators[$type] ) )
            {
                $ret = self::$validators[$type]( $value, $params );
            }
        }
        return $ret;
    }

    /**
     * Validator::_isDate()
     * is date?? 
     *
     * @param string $s
     * @return bool
     */
    private static function _isDate( $s )
    {
        $pattern = "/^(19|20)\d{2}[\-](0[1-9]|1[0-2])[\-](0[1-9]|[12][0-9]|3[01])$/";
        return ( preg_match( $pattern, $s ) );
    }

    /**
     * Validator::_regex()
     * validate string with different type
     * 
     *
     * @access    public
     * @param string $v
     * @param string $type
     * @return string
     */
    private function _regex( $v, $type )
    {
        $tmp_str = trim( $v );
        $isnull = ( $v == null );
        if ( ( ! @preg_match( self::$rules[$type], $tmp_str ) ) && ( ! $isnull ) )
        {
            return false;
        }
        return true;
    }

}
