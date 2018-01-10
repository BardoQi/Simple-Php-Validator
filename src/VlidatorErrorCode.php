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

/**
 * VlidatorErrorCode Class
 * 
 * 
 * @package        Bulo
 * @subpackage    core
 * @category    Validator
 * @author        Bulo Dev Team: Bardo QI
 * @link        http://Bulo.pisx.com/user_guide/core/Validator.html
 */
class VlidatorErrorCode
{
    const 
        __default = self::FORMAT_ERROR, 
        FORMAT_ERROR = "FORMAT_ERROR",
        REQUIRED = "REQUIRED", 
        CANNOT_BE_EMPTY = "CANNOT_BE_EMPTY", 
        TOO_LONG = "TOO_LONG", 
        TOO_SHORT = "TOO_SHORT", 
        WRONG_EMAIL = "WRONG_EMAIL",
        WRONG_DATE = "WRONG_DATE", 
        FIELDS_NOT_EQUAL = "FIELDS_NOT_EQUAL",
        TOO_LOW = "TOO_LOW", 
        TOO_HIGH = "TOO_HIGH", 
        NOT_DECIMAL = "NOT_DECIMAL",
        NOT_POSITIVE_DECIMAL = "NOT_POSITIVE_DECIMAL", 
        NOT_INTEGER = "NOT_INTEGER", 
        NOT_POSITIVE_INTEGER = "NOT_POSITIVE_INTEGER";
}
