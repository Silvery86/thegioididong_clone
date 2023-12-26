<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:29 PM
 **/

namespace app\helpers;

use app\lib\Smtp;

/**
 * Email helper.
 */
class EmailHelper
{

    /**
     * Check if an email is on the white-list or not.
     *
     * @param  string  $email
     *
     * @return bool
     */
    public static function isInWhiteList(string $email): bool
    {
        $whitelist = self::getEmailWhitelist();
        $suffix    = self::getEmailSuffix($email);
        if ( ! in_array($suffix, $whitelist)) {
            return false;
        }

        return true;
    }

    /**
     * Returns the email suffix.
     *
     * @param  string  $email
     *
     * @return string
     */
    public static function getEmailSuffix(string $email): string
    {
        $suffix = explode('@', $email);

        return '@'.$suffix[1];
    }

    /**
     * Send an email.
     *
     * @param  string  $subject
     * @param  string  $message
     * @param  string  $recipient
     * @param  bool  $is_html
     * @param  bool  $secure
     * @param  array  $attachments
     *
     * @return bool
     */
    public static function send(
        string $subject,
        string $message,
        string $recipient,
        bool $is_html = true,
        bool $secure = true,
        array $attachments = []
    ): bool {
        $smtp = self::getSmtp();
        if ( ! empty($smtp)) {
            $mail = new Smtp($smtp['smtp_server'], $smtp['smtp_port']);
            if ($secure === true) {
                $mail->setProtocol(Smtp::TLS);
            }
            $mail->setLogin($smtp['smtp_username'], $smtp['smtp_password']);
            $mail->setFrom($smtp['smtp_sender_email'], $smtp['smtp_sender_name']);
            $mail->setSubject($subject);
            if ($is_html === true) {
                $mail->setHtmlMessage($message);
            } else {
                $mail->setTextMessage($message);
            }
            $mail->addTo($recipient);
            if ( ! empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $mail->addAttachment($attachment);
                }
            }
            if ( ! $mail->send()) {
                echo 'An error has occurred. Please check the logs below:'.PHP_EOL;
                print_r($mail->getLogs());

                return false;
            }
        }

        return true;
    }

    /**
     * Get email whitelist config.
     *
     * @return array|null
     */
    private static function getEmailWhitelist(): ?array
    {
        return self::getConfigParams('email_whitelist');
    }

    /**
     * Get SMTP config.
     *
     * @return array|null
     */
    private static function getSmtp(): ?array
    {
        return self::getConfigParams('smtp');
    }

    /**
     * Get config params.
     *
     * @param  string  $name
     *
     * @return mixed|null
     */
    private static function getConfigParams(string $name): mixed
    {
        $params = include __DIR__.'/../config/params.php';

        return ! empty($params[$name]) ? $params[$name] : null;
    }
}
