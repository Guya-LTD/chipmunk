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

namespace Chipmunk\Repository;

/**
 * Interface MailerInterface
 * @package Chipmunk\Repository
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

interface MailerInterface {
    public function setDebug ( string $debug );
    public function setHost ( string $host );
    public function setUsername ( string $username );
    public function setPassword ( string $password );
    public function setSecurity ( string $security );
    public function setPort ( int $port );
    public function from( string $from );
    public function to( string $to );
    public function isHTML( bool $isHtml );
    public function subject ( string $subject );
    public function body ( string $body );
    public function initSMTP ();
    public function send();
}

/** EOF */