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

namespace Chipmunk\Message\Consumer;

use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Interface BillingMethodInterface
 * @package Xpress\Domain\Service\Repository
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

class ExampleConsumer {
    /**
     * @var AMQPStreamConnection
     */
    private $channel;

    /**
     * @param AMQPStreamConnection $channel
     * @return $this
     */
    public function __constructor( $channel ) {
        $this->channel = $channel;
    }

    /**
     * @return void
     */
    public function consume() : void {
        $callback = function ( $msg ) {
            echo "Reviced", $msg->body;
        };

        $this->channel->basic_consume('example', '', false, true, false, false, $callback);

        // Loop
        while($channel->is_consuming()) {
            $this->channel->wait();
        }
    }
}

/** EOF */