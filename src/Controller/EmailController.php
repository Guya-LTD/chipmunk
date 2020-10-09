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

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

/**
 * Class EmailController
 * @package App\Controller
 * @Route("/api/v1", name="email_api")
 * @see https://github.com/Guya-LTD/chipmunk/tree/master
 * @author Simon Belete <simonbelete@gmail.com> 
 * @license UNLICENSED
 * @copyright (C) Guya
 * @version  1.0.0
 */
class EmailController extends AbstractController {
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("/emails", name="send_email", method={"POST"})
     */
    public function sendEmail(Request $request, MailerInterface $mailer){
        try{
            // Parse requests
            // Validate if request containes values
            if(!$request || $request->get('type'))
                throw new \Exception();
            
            /*$email = (new Email())
                ->from('account@guya.com')
                ->to($request->get('simonbelete@gmail.com'))
                ->subject('Guya Account')
                ->htmlTemplate('templates/email/password-reset.html.en.twig')
                ->context([
                    'username' => 'Test user'
                ]);*/

            $email = (new Email())
            ->from('simonbelete@gmail.com')
            ->to('simonbelete@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);

            return new Response("mailed");

        } catch (TransportExceptionInterface $ex) {
            // Email Sending failer
            return new Response($ex);
        } catch (\Exception $ex){
            $res = [
                'status_code' => 422,
                'status' => 'Unprocessable',
                'error' => [
                    'type' => 'Exception',
                    'message' => 'Data not valid'
                ]
            ];
            return new Response($ex);
        }
    }
}

/** EOF */