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
class PasswordEmailController extends AbstractController {
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     * @Route("/emails", name="send_email", method={"POST"})
     */
    public function sendEmail(Request $request, MailerInterface $mailer){
        try{
            $params = array();
            $content = $request->getContent();
            $params = json_decode($content, true);
            // Parse requests
            // Validate if request containes values
            if( !array_key_exists("to", $params) ||
                $params['to'] == ""
                )
                return new JsonResponse(
                    [
                        'status_code' => 400,
                        'status' => 'Bad Request',
                        'message' => 'One of the payload is empty',
                        'payloads' => $params
                    ],
                    400
                );

            $email = new TemplatedEmail();
            $email->from($_SERVER['ACCOUNT_SENDER_EMAIL'])
                  ->to($params['to'])
                  ->subject('Guya Account, Password Reset')
                  ->htmlTemplate('emails/password-reset-en.html.twig')
                  ->context([
                      'name' => $params['name'],
                      'operating_system' => $params['operating_system'],
                      'browser_name' => $params['browser_name'],
                      'action_url' => $params['reset_url'],
                      'support_email' => 'support@localhost.com',
                      'support_url' => 'http://127.0.0.1:50000/admin-panel'
                  ]);

            $mailer->send($email);

            $res = [
                'status_code' => 201,
                'status' => 'Created',
                'message' => 'Mail Sent'
            ];

            return new JsonResponse($res, 201);

        } catch (TransportExceptionInterface $ex) {
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