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

use Chipmunk\Helper\Environment;
use Chipmunk\Adapter\RabbitMQAdapter;
use Chipmunk\Factory\RabbitMQFactoryInterface;

/**
 * Class RabbitMQFactory
 * @package Chipmunk\Factory
 * @see https://github.com/Simonbelete/guya/tree/develop/xpress
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */

class RabbitMQFactory implements RabbitMQFactoryInterface {
    public function createWithConnection() {
        // Object Variables
        $host = Environment::get($this::ENV_RABBITMQ_HOST_NAME);
        $port = Environment::get($this::ENV_RABBITMQ_PORT_NAME);
        $username = Environment::get($this::ENV_RABBITMQ_USERNAME_NAME);
        $password = Environment::get($this::ENV_RABBITMQ_PASSWORD_NAME);
        /*
        $host = "asdf";
        $port = "5672";
        $username = "rabbitmq_user";
        $password = "0875e68ce5";
        */
        // Create RabbitmqAdaper Object
        $rabbitMQAdapter = new RabbitMQAdapter();
        $rabbitMQAdapter->setHost($host)
                        ->setPort($port)
                        ->setUsername($username)
                        ->setPassword($password);

        // Establish connection to rabbitmq
        // Throws \Exception
        $rabbitMQAdapter->connect();

        // Init rabbitmq channel
        // Throws \Exception
        // Returns new Chaneel
        return $rabbitMQAdapter->initChannel();
    }
}