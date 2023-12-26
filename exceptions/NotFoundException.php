<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:28 PM
 **/

namespace core\exceptions;

use Exception;

/**
 * NotFound exception.
 * Throw the not found exception.
 */
class NotFoundException extends Exception
{

    /**
     * @var string $message Error message
     */
    protected $message = 'Page not found';
    /**
     * @var int $code Error code
     */
    protected $code = 404;
}
