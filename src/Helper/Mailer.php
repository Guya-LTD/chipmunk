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

namespace App\Helper;

use Symfony\Component\Mime\Email;

class Mailer {
    /**
     * @param MailerInterface $mailer
     */
    public function sendEmail(MailerInterface $mailer){
        $email = (new Email())
            ->from('team@guya.com')
            ->to();
        
        return $mailer->send($email);
    }
}

/** EOF */