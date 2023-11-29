<?php

namespace App\Controller\Bitrix;

use App\Service\Bitrix\ClientManagerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{
    Request,
    Response
};
use Symfony\Component\Routing\Annotation\Route;

#[Route('/install', name: 'install')]
class InstallController extends AbstractController
{
    public function execute(Request $request, ClientManagerService $client): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/html');

        // Check type of request and that a request from the Bitrix
        if ($request->isMethod('POST') && $request->request->get('PLACEMENT') == 'DEFAULT') {
            $response->setContent('
                <html>
                    <head>
                        <script src="//api.bitrix24.com/api/v1/"></script>
                        <script>
                            BX24.init(function () {
                                BX24.installFinish();
                            });
                        </script>
                    </head>
                    <body>
                    </body>
                </html>');

            $expires = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Warsaw'));

            // Save keys
            $client->set(
                $request->request->get('member_id'),
                $request->query->get('DOMAIN'),
                null,
                1,
                true,
                $request->request->get('AUTH_ID'),
                $request->request->get('REFRESH_ID'),
                $expires->modify('+3590 seconds')->getTimestamp()
            );
        } else {
            // Return error
            $response->setStatusCode(Response::HTTP_FORBIDDEN);
        }

        return $response;
    }
}