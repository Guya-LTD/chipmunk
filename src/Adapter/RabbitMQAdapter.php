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

use PhpAmqpLib\Connection\AMQPStreamConnection;

use Chipmunk\Repository\RabbitMQInterface;

/**
 * Interface BillingMethodInterface
 * @package Xpress\Domain\Service\Repository
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

class RabbitMQAdapter implements RabbitMQInterface {
    /**
     * @var PhpAmqpLib\Connection\AMQPStreamConnection
     */
    private $connection;

    /**
     * @var PhpAmqpLib\Connection\AMQPStreamConnection\Channel
     */
    private $channel;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $host
     * @return $this
     */
    public function setHost ( string $host ) : self {
        $this->host = $host;
        return $this;
    }

    /**
     * @param int $port
     * @return $this
     */
    public function setPort( int $port ) : self {
        $this->port = $port;
        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername ( string $username ) : self {
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
     * @return $this
     */
    public function connect () : self {
        try {
            $this->connection = new AMQPStreamConnection(
                $this->host,
                $this->port,
                $this->username,
                $this->password
            );
        } catch ( Exception $ex ){
            echo "Rabbitmq Connection Error: {$ex}";
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function initChannel () {
        try{
            $this->channel = $this->connection->channel();
        } catch ( Exception $ex ){
            echo "Error Occured on Initing channel: {$ex}";
        }
        
        return $this->channel;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function waitingMessage ( $name ) : self {
        echo " [*] Waiting for messages. To exit press CTRL+c\n";
    }

    /**
     * @param string $msg
     * @return $this
     */
    public function recivedMessage ( string $msg ) : self {
        
    }

    /**
     * @return $this
     */
    public function declare () : self {
        
    }

    /**
     * @return $this
     */
    public function closeChannel () : self {

    }

    /**
     * @return $this
     */
    public function closeConnection () : self {

    }

    /**
     * @return $this
     */
    public function close () : self {
        $this->closeChannel();
        $this->closeConnection();
    }
}