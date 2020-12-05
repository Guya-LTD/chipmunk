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

namespace Chipmunk\Factory;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

use Chipmunk\Helper\Environment;
use Chipmunk\Adapter\MailerAdapter;
use Chipmunk\Factory\MailerFactoryInterface;

/**
 * Class MailerFactory
 * @package Chipmunk\Factory
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

class MailerFactory implements MailerFactoryInterface {
    public function createWithConnection() {
        // Object Variables
        $debug = SMTP::DEBUG_SERVER;
        $host = Environment::get($this::ENV_HOST_NAME);
        $smtpAuth = true;
        $username = Environment::get($this::ENV_USERNAME_NAME);
        $password = Environment::get($this::ENV_PASSWORD_NAME);
        $security = PHPMailer::ENCRYPTION_STARTTLS;
        $port = Environment::get($this::ENV_PORT_NAME);
        
        // Create MailerAdaper Object
        $mailerAdapter = new MailerAdapter(true);
        $mailerAdapter->setDebug($debug)
                      ->setHost($host)
                      ->setSmtpAuth($smtpAuth)
                      ->setUsername($username)
                      ->setPassword($password)
                      ->setSecurity($security)
                      ->setPort($port);

        return $mailerAdapter;
    }
}

/** EOF */