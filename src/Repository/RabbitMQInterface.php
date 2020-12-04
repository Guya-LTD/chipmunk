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

namespace Chipmunk\Repositgory;

/**
 * Interface RabbitMQInterface
 * @package Xpress\Domain\Service\Repository
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

interface RabbitMQInterface {
    public function setHost( string $host );
    public function setPort( string $port );
    public function setUsername( string $username );
    public function setPassword( string $password );
    public function connect();
    public function initChannel();
    public function waitingMessage();
    public function recivedMessage( string $msg );
    public function channel( string $publishName );
    public function closeChannel();
    public function closeConnection();
    public function close();
}

/** EOF */