<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:53 PM
 **/

namespace app\lib;

use JetBrains\PhpStorm\Pure;

/**
 * Class SmtpTransport.
 * This class handles sending email classes using SMTP Authentication.
 */
class Smtp
{

    const CRLF = "\r\n";

    const TLS  = 'tcp';

    const SSL  = 'ssl';

    const OK   = 250;

    /**
     * @var string $server Servername
     */
    protected string $server;
    /**
     * @var string $hostname Hostname
     */
    protected string $hostname;
    /**
     * @var int $port Port
     */
    protected int $port;
    /**
     * @var mixed $socket Socket
     */
    protected mixed $socket;
    /**
     * @var string $username Username
     */
    protected string $username;
    /**
     * @var string $password Password
     */
    protected string $password;
    /**
     * @var int $connectionTimeout Connection timeout
     */
    protected int $connectionTimeout;
    /**
     * @var int $responseTimeout Response timeout
     */
    protected int $responseTimeout;
    /**
     * @var string $subject Email subject
     */
    protected string $subject;
    /**
     * @var array $to Send to
     */
    protected array $to = [];
    /**
     * @var array $cc CC
     */
    protected array $cc = [];
    /**
     * @var array $bcc BCC
     */
    protected array $bcc = [];
    /**
     * @var array $from Send from
     */
    protected array $from = [];
    /**
     * @var array $replyTo Reply to
     */
    protected array $replyTo = [];
    /**
     * @var array $attachments Email attachments
     */
    protected array $attachments = [];
    /**
     * @var string|null $protocol Smtp protocol
     */
    protected ?string $protocol = null;
    /**
     * @var string|null $textMessage Email text message
     */
    protected ?string $textMessage = null;
    /**
     * @var string|null $htmlMessage Email html message
     */
    protected ?string $htmlMessage = null;
    /**
     * @var bool $isHTML Check if the email message is HTML or Plaintext
     */
    protected bool $isHTML = false;
    /**
     * @var bool $isTLS Check if the TLS is enabled or not
     */
    protected bool $isTLS = false;
    /**
     * @var array $logs Logs
     */
    protected array $logs = [];
    /**
     * @var string $charset Charset
     */
    protected string $charset = 'utf-8';
    /**
     * @var array $headers Headers
     */
    protected array $headers = [];

    /**
     * SmtpTransport constructor.
     *
     * @param  string  $server
     * @param  int  $port
     * @param  int  $connectionTimeout
     * @param  int  $responseTimeout
     * @param  string|null  $hostname
     */
    public function __construct(
        string $server,
        int $port = 25,
        int $connectionTimeout = 30,
        int $responseTimeout = 8,
        ?string $hostname = null
    ) {
        $this->port              = $port;
        $this->server            = $server;
        $this->connectionTimeout = $connectionTimeout;
        $this->responseTimeout   = $responseTimeout;
        $this->hostname          = empty($hostname) ? gethostname() : $hostname;
        $this->setHeader('X-Mailer', 'PHP/'.phpversion());
        $this->setHeader('MIME-Version', '1.0');
    }

    /**
     * Set header.
     *
     * @param  string  $key
     * @param  mixed|null  $value
     *
     * @return Smtp
     */
    public function setHeader(string $key, mixed $value = null): Smtp
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * Add to recipient email address.
     *
     * @param  string  $address
     * @param  string|null  $name
     *
     * @return Smtp
     */
    public function addTo(string $address, ?string $name = null): Smtp
    {
        $this->to[] = [
            $address,
            $name,
        ];

        return $this;
    }

    /**
     * Add carbon copy email address.
     *
     * @param  string  $address
     * @param  string|null  $name
     *
     * @return Smtp
     */
    public function addCc(string $address, ?string $name = null): Smtp
    {
        $this->cc[] = [
            $address,
            $name,
        ];

        return $this;
    }

    /**
     * Add blind carbon copy email address.
     *
     * @param  string  $address
     * @param  string|null  $name
     *
     * @return Smtp
     */
    public function addBcc(string $address, ?string $name = null): Smtp
    {
        $this->bcc[] = [
            $address,
            $name,
        ];

        return $this;
    }

    /**
     * Add email reply to address.
     *
     * @param  string  $address
     * @param  string|null  $name
     *
     * @return Smtp
     */
    public function addReplyTo(string $address, ?string $name = null): Smtp
    {
        $this->replyTo[] = [
            $address,
            $name,
        ];

        return $this;
    }

    /**
     * Add file attachment.
     *
     * @param  string  $attachment
     *
     * @return Smtp
     */
    public function addAttachment(string $attachment): Smtp
    {
        if (file_exists($attachment)) {
            $this->attachments[] = $attachment;
        }

        return $this;
    }

    /**
     * Set SMTP Login authentication.
     *
     * @param  string  $username
     * @param  string  $password
     *
     * @return Smtp
     */
    public function setLogin(string $username, string $password): Smtp
    {
        $this->username = $username;
        $this->password = $password;

        return $this;
    }

    /**
     * Get message character set.
     *
     * @param  string  $charset
     *
     * @return Smtp
     */
    public function setCharset(string $charset): Smtp
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Set SMTP Server protocol.
     *
     * @param  string|null  $protocol
     *
     * @return Smtp
     */
    public function setProtocol(?string $protocol = null): Smtp
    {
        if ($protocol === self::TLS) {
            $this->isTLS = true;
        }
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * Set from email address and/or name.
     *
     * @param  string  $address
     * @param  string|null  $name
     *
     * @return Smtp
     */
    public function setFrom(string $address, ?string $name = null): Smtp
    {
        $this->from = [
            $address,
            $name,
        ];

        return $this;
    }

    /**
     * Set email subject string.
     *
     * @param  string  $subject
     *
     * @return Smtp
     */
    public function setSubject(string $subject): Smtp
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set plain text message body.
     *
     * @param  string  $message
     *
     * @return Smtp
     */
    public function setTextMessage(string $message): Smtp
    {
        $this->textMessage = $message;

        return $this;
    }

    /**
     * Set html message body.
     *
     * @param  string  $message
     *
     * @return Smtp
     */
    public function setHtmlMessage(string $message): Smtp
    {
        $this->htmlMessage = $message;

        return $this;
    }

    /**
     * Get log array.
     *
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * Send email to recipient via mail server.
     *
     * @return bool
     */
    public function send(): bool
    {
        $message      = null;
        $this->socket = fsockopen(
            $this->getServer(),
            $this->port,
            $errorNumber,
            $errorMessage,
            $this->connectionTimeout
        );
        if (empty($this->socket)) {
            return false;
        }
        $this->logs['CONNECTION'] = $this->getResponse();
        $this->logs['HELLO'][1]   = $this->sendCommand('HELLO '.$this->hostname);
        if ($this->isTLS) {
            $this->logs['START_TLS'] = $this->sendCommand('START TLS');
            stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            $this->logs['HELLO'][2] = $this->sendCommand('HELLO '.$this->hostname);
        }
        $this->logs['AUTH']      = $this->sendCommand('AUTH LOGIN');
        $this->logs['USERNAME']  = $this->sendCommand(base64_encode($this->username));
        $this->logs['PASSWORD']  = $this->sendCommand(base64_encode($this->password));
        $this->logs['MAIL_FROM'] = $this->sendCommand('MAIL FROM: <'.$this->from[0].'>');
        $recipients              = array_merge($this->to, $this->cc, $this->bcc);
        foreach ($recipients as $address) {
            $this->logs['RECIPIENTS'][] = $this->sendCommand('RCPT TO: <'.$address[0].'>');
        }
        $this->setHeader('Date', date('r'));
        $this->setHeader('Subject', $this->subject);
        $this->setHeader('From', $this->formatAddress($this->from));
        $this->setHeader('Return-Path', $this->formatAddress($this->from));
        $this->setHeader('To', $this->formatAddressList($this->to));
        if ( ! empty($this->replyTo)) {
            $this->setHeader('Reply-To', $this->formatAddressList($this->replyTo));
        }
        if ( ! empty($this->cc)) {
            $this->setHeader('Cc', $this->formatAddressList($this->cc));
        }
        if ( ! empty($this->bcc)) {
            $this->setHeader('Bcc', $this->formatAddressList($this->bcc));
        }
        $boundary = md5(uniqid(microtime(true), true));
        $this->setHeader('Content-Type', 'multipart/mixed; boundary="mixed-'.$boundary.'"');
        if ( ! empty($this->attachments)) {
            $this->headers['Content-Type'] = 'multipart/mixed; boundary="mixed-'.$boundary.'"';
            $message                       .= '--mixed-'.$boundary.self::CRLF;
            $message                       .= 'Content-Type: multipart/alternative; boundary="alt-'.$boundary.'"'.self::CRLF.self::CRLF;
        } else {
            $this->headers['Content-Type'] = 'multipart/alternative; boundary="alt-'.$boundary.'"';
        }
        if ( ! empty($this->textMessage)) {
            $message .= '--alt-'.$boundary.self::CRLF;
            $message .= 'Content-Type: text/plain; charset='.$this->charset.self::CRLF;
            $message .= 'Content-Transfer-Encoding: base64'.self::CRLF.self::CRLF;
            $message .= chunk_split(base64_encode($this->textMessage)).self::CRLF;
        }
        if ( ! empty($this->htmlMessage)) {
            $message .= '--alt-'.$boundary.self::CRLF;
            $message .= 'Content-Type: text/html; charset='.$this->charset.self::CRLF;
            $message .= 'Content-Transfer-Encoding: base64'.self::CRLF.self::CRLF;
            $message .= chunk_split(base64_encode($this->htmlMessage)).self::CRLF;
        }
        $message .= '--alt-'.$boundary.'--'.self::CRLF.self::CRLF;
        if ( ! empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                $filename = pathinfo($attachment, PATHINFO_BASENAME);
                $contents = file_get_contents($attachment);
                $type     = mime_content_type($attachment);
                if ( ! $type) {
                    $type = 'application/octet-stream';
                }
                $message .= '--mixed-'.$boundary.self::CRLF;
                $message .= 'Content-Type: '.$type.'; name="'.$filename.'"'.self::CRLF;
                $message .= 'Content-Disposition: attachment; filename="'.$filename.'"'.self::CRLF;
                $message .= 'Content-Transfer-Encoding: base64'.self::CRLF.self::CRLF;
                $message .= chunk_split(base64_encode($contents)).self::CRLF;
            }
            $message .= '--mixed-'.$boundary.'--';
        }
        $headers = '';
        foreach ($this->headers as $k => $v) {
            $headers .= $k.': '.$v.self::CRLF;
        }
        $this->logs['MESSAGE'] = $message;
        $this->logs['HEADERS'] = $headers;
        $this->logs['DATA'][1] = $this->sendCommand('DATA');
        $this->logs['DATA'][2] = $this->sendCommand($headers.self::CRLF.$message.self::CRLF.'.');
        $this->logs['QUIT']    = $this->sendCommand('QUIT');
        fclose($this->socket);

        return substr($this->logs['DATA'][2], 0, 3) == self::OK;
    }

    /**
     * Get server url.
     *
     * @return string
     */
    protected function getServer(): string
    {
        return ($this->protocol) ? $this->protocol.'://'.$this->server : $this->server;
    }

    /**
     * Get Mail Server response.
     *
     * @return string
     */
    protected function getResponse(): string
    {
        $response = '';
        stream_set_timeout($this->socket, $this->responseTimeout);
        while (($line = fgets($this->socket, 515)) !== false) {
            $response .= trim($line)."\n";
            if (substr($line, 3, 1) == ' ') {
                break;
            }
        }

        return trim($response);
    }

    /**
     * Send command to mail server.
     *
     * @param  string  $command
     *
     * @return string
     */
    protected function sendCommand(string $command): string
    {
        fputs($this->socket, $command.self::CRLF);

        return $this->getResponse();
    }

    /**
     * Format email address (with name).
     *
     * @param  array  $address
     *
     * @return string
     */
    protected function formatAddress(array $address): string
    {
        return (empty($address[1])) ? $address[0] : '"'.addslashes($address[1]).'" <'.$address[0].'>';
    }

    /**
     * Format email address to list.
     *
     * @param  array  $addresses
     *
     * @return string
     */
    #[Pure] protected function formatAddressList(array $addresses): string
    {
        $data = [];
        foreach ($addresses as $address) {
            $data[] = $this->formatAddress($address);
        }

        return implode(', ', $data);
    }
}
