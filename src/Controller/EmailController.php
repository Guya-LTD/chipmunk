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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


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
     * @return \Email
     */
    public function getPasswordResetEmail(Request $request){
        $email = (new TemplatedEmail())
            ->from($_SERVER['ACCOUNT_SENDER_EMAIL'])
            ->to($request->get('to'))
            ->subject('Guya Account')
            ->htmlTemplate('emails/password-reset-en.html.twig')
            ->context([
                'name' => $request->get('name'),
                'action_url' => $request->get('action_url'),
                'operating_system' => $request->get('operating_system'),
                'browser_name' => $request->get('browser_name'),
                'support_url' => $request->get('support_url')
            ]);

        return $email;
    }

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
            if(!$request || $request->get('type') == null || $request->get('to') == null)
                throw new \Exception("Pyaload is Empyt");
            
            if($request->get('type') == 'reset-password')
                $mailer->send(
                    $this->getPasswordResetEmail($request)
                );

            $res = [
                'status_code' => 201,
                'status' => 'Created',
                'message' => 'Mail Sent'
            ];

            return new JsonResponse($res, 201);

        } catch (TransportExceptionInterface $ex) {
            print($ex);
            // Email Sending failer
            $res = [
                'status_code' => 422,
                'status' => 'Unprocessable',
                'message' => 'Mailer Exception',
                'error' => [
                    'type' => 'TransportExceptionInterface',
                    'message' => $ex
                ]
            ];
            return new JsonResponse($res, 500);
        } catch (\Exception $ex){
            print($ex);
            $res = [
                'status_code' => 500,
                'status' => 'Unprocessable',
                'message' => 'General Exception',
                'error' => [
                    'type' => 'Exception',
                    'message' => $ex
                ]
            ];
            return new JsonResponse($res, 500);
        }
    }
}

/** EOF */