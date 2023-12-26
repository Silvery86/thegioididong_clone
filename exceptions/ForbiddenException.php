<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:27 PM
 **/

namespace core\exceptions;

use Exception;

/**
 * Forbidden exception.
 * Throw the forbidden exception.
 */
class ForbiddenException extends Exception
{

    /**
     * @var string $message Error message
     */
    protected $message = 'You don\'t have permission to access this page';
    /**
     * @var int $code Error code
     */
    protected $code = 403;
}
