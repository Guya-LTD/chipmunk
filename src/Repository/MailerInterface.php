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
    public function setDebug ( $debug );
    public function setHost ( $host );
    public function setUsername ( $username );
    public function setPassword ( $password );
    public function setSecurity ( $security );
    public function setPort ( $port );
    public function from( $from );
    public function to( $to );
    public function isHTML( $isHtml );
    public function subject ( $subject );
    public function body ( $body );
    public function initSMTP ();
    public function send();
}

/** EOF */