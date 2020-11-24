<?php
/**
 * @copyright (C) Guya , PLC - All Rights Reserved (As Of Pending...)
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 *
 * @author: Simon Belete <simonbelete>
 * @date:   2020-05-13T03:14:09+03:00
 * @email:  simonbelete@gmail.com
 * @project: Guya Express Xpress Service
 * @last modified by:   simonbelete
 * @last modified time: 2020-05-13T04:32:15+03:00
 */

namespace Chipmunk\Adapter;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Chipmunk\Repository\MailerInterface;

/**
 * Class MailerAdapter
 * @package Xpress\Domain\Service\Repository
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

class MailerAdapter implements MailerInterface {
    /**
     * @var PHPMailer\PHPMailer\PHPMailer
     */
    private $mail;

    /**
     * @var string
     */
    private $debug;

    /**
     * @var string
     */
    private $host;

    /**
     * @var bool
     */
    private $smtpAuth;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $security;

    /**
     * @var int
     */
    private $port;

    /**
     * @var bool
     */
    private $isHtml;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @return $this
     */
    public function __construct ( $exception = true) {
        // Instantiation and passing `true` enables exceptions
        $this->mail = new PHPMailer($exception);
    }

    /**
     * @param string $debug
     * @return $this
     */
    public function setDebug ( string $debug = SMTP::DEBUG_SERVER ) : self {
        $this->debug = $debug;
        return $this;
    }

    /**
     * @param string $host
     * @return $this
     */
    public function setHost ( string $host ) : self {
        $this->host = $host;
        return $this;
    }

    /**
     * @param bool $smtpAuth
     * @return $this
     */
    public function setSmtpAuth ( bool $smtpAuth = true ) : self {
        $this->smtpAuth = $smtpAuth;
        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername ( stirng $username ) : self {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword ( string $password ) : self {
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $security
     * @return $this
     */
    public function setSecurity ( string $security ) : self {
        $this->security = $security;
        return $this;
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setPort ( int $port ) : self {
        $this->port = $port;
        return $this;
    }

    /**
     * @param bool $isHtml
     * @return $this
     */
    public function isHTML ( bool $isHtml ) : self {
        $this->isHtml = $isHtml;
        return $this;
    }

    /**
     * @param string $from
     * @return $this
     */
    public function from ( string $from ) : self {
        $this->from = $from;
        return $this;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function to ( string $to ) : self {
        $this->to = $to;
        return $this;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function subject ( string $subject ) : self {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function body ( string $body ) : self {
        $this->body = $body;
        return $body;
    }

    /**
     * @return $this
     */
    public function initSMTP () : self {
        // Enable or Disable verbose debug output
        $this->mail = $this->debug;
        // Send using SMTP
        $this->mail->isSMTP();
        // Set the SMTP server to send through
        $this->mail->Host = $this->host;
        // Enable or Disable SMTP authentication
        $this->mail->SMTPAuth = $this->smtpAuth;
        // SMTP username
        $this->mail->Username = $this->username;
        // SMTP password
        $this->mail->Password = $this->password;
        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $this->mail->SMTPSecure = $this->security;
        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $this->mail->Port = $this->port;

        // Recipients
        $this->mail->setFrom( $this->from );
        $this->mail->addAddress( $this->to );

        // Content
        $this->mail->isHTML( $this->isHtml );
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->body;
    }

    /**
     * @return bool
     */
    public function send() : bool {
        try {
            $this->mail->send();
            return true;
        } catch ( Exception $ex ) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}