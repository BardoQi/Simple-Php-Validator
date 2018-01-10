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
 * @package    Validator
 * @since       Version 1.0
 * @filesource
 */

namespace Bulo\Library\Validator;

use Bulo\Library\Validator\Validator;

/**
 * VlidatorRule Class
 * 
 *
 * @package        Bulo
 * @subpackage    core
 * @category    Validator
 * @author        Bulo Dev Team: Bardo QI
 * @link        http://www.Bulo.org/user_guide/core/Validator.html
 */
class VlidatorRule
{
    public static $rules = array(
        'mail' => "/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/",
        'integer' => '/^[-\+]?\d+$/',
        'double' => '/^[-\+]?\d+(\.\d+)?$/',
        'currency' => '/^\d+(\.\d+)?$/',
        'number' => '/^\d+$/',
        'zipcode' => '/^[1-9]\d{5}$/',
        'english' => '/^[A-Za-z]+$/',
        'username' => '/^[a-z_\x{4e00}-\x{9fa5}][a-zA-Z0-9_\x{4e00}-\x{9fa5}]+$/u',
        'url' => '/[a-zA-z]+:\/\/[^\s]*/',
        'phone' => '/\d{3}-\d{8}|\d{4}-\d{7,8}/',
        'mobile' => '/^(13[0-9]|15[0|1|2|3|5|6|7|8|9]|18[0|2|5|6|7|8|9])\d{8}$/',
        'qq' => '/^[1-9][0-9]{4,}$/',
        'date' => '/^(19|20)\d{2}[\-](0[1-9]|1[0-2])[\-](0[1-9]|[12][0-9]|3[01])$/',
        'time' => '/^(20|21|22|23|[0-1]?\d):[0-5]?\d:[0-5]?\d$/',
        'datetime' => '/^(19|20)\d{2}[\-](0[1-9]|1[0-2])[\-](0[1-9]|[12]\d|3[01]) ([0-1]\d|2[0-3]):[0-5]?\d:[0-5]?\d$/',
        'yearmonth' => '/^(19|20)[0-9]{2}[-](0[1-9]|1[012])$/',
        'ipaddress' => '/^\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b$/',
        'color' => '/^\#[a-fA-F0-9]{6}$/',
        );
}

/**
 * minlen()
 * validate Minimum Length
 * 
 *
 * @param mixed $v
 * @param mixed $title
 * @param mixed $params
 * @return 
 */
Validator::add( "minlen", function ( $v, $params )
{
    if ( strlen( $v ) < $params['len'] )
    {
        return false; 
    }
    return true; 
});


/**
 * maxlen()
 *
 * @param mixed $v
 * @param mixed $title
 * @param mixed $params
 * @return
 */
Validator::add( "maxlen", function ( $v, $params )
{
    if ( strlen( $v ) > $params['len'] )
    {
        return false; 
    }
    return true; 
});


/**
 * chinese()
 * validate chinese string
 * 
 * @access    public static
 * @param string $v
 * @return
 */
Validator::add( "chinese", function ( $v, $params = null )
{
    mb_internal_encoding( "UTF-8" ); 
    if ( strlen( $v ) - 3 * mb_strlen( $v ) < 0 )
    {
        return false; 
    }
    return true; 
});

/**
 * idcard()
 * validate the string is valid chinese id card number.
 * 
 *
 * @access public static 
 * @param string $v
 * @param string $params ( lang : IDCARD_AREA)
 * @return bool
 */
Validator::add( "idcard", function ( $v, $params = null )
{
    $verify = "10x98765432"; 
    $Wi = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2 ); 
    $area = $params['area']; 
    $pattern = '/^(\d{2})\d{4}(((\d{2})(\d{2})(\d{2})(\d{3}))|((\d{4})(\d{2})(\d{2})(\d{3}[x\d])))$/i';
    $macthes = ''; 
    if ( ! preg_match( $pattern, $v, $macthes ) )
    {
        return false; 
    }
    if ( $macthes[1] >= count( $area ) || $area[$macthes[1]] == "" )
    {
        return false; 
    }
    if ( strlen( $macthes[2] ) == 12 )
    {
        $Ai = substr( $v, 0, 17 ); 
        $date = implode( "-", array($macthes[9],$macthes[10],$macthes[11] ) );
    }
    else
    {
        $Ai = substr( $v, 0, 6 ) . "19" . substr( $v, 6 ); 
        $date = implode( "-",array("19" . $macthes[4],$macthes[5],$macthes[6] ) ); 
    }
    if ( ! validator::_isDate( $date ) )
    {
        return false; 
    }
    $sum = 0; for ( $i = 0; $i <= 16; $i++ )
    {
        $sum += substr( $Ai, $i, 1 ) * $Wi[$i]; 
    }
    $Ai += substr( $verify, $sum % 11, 1 ); 
    if ( ! ( strlen( $v ) == 15 || strlen( $v ) ==18 ) && $v == $Ai )
    {
        return false; 
    }
    return true; 
});


/**
 * string()
 * 
 * @access public static 
 * @param mixed $v
 * @return
 */
Validator::add( "string", function ( $v, $params = null )
{
    if ( preg_match( "/<(.*)>.*<\/\1>|<(.*) \/>/", $v ) )
    {
        return false; 
    }
    return true; 
});


/**
 * text()
 *
 * @param mixed $v
 * @return
 */
Validator::add( "text", function ( $v, $params = null )
{
    if ( preg_match( "/<(.*)>.*<\/\1>|<(.*) \/>/", $v ) )
    {
        return false; 
    }
    return true; 
});

