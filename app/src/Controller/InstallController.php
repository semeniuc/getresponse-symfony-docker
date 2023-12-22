<?php

declare(strict_types=1);
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\BitrixManagerService;

class InstallController extends AbstractController
{
    #[Route('/install', name: 'install')]
    public function install(Request $request, BitrixManagerService $bitrixManagerService): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/html');

        // Check type of request and that a request from the Bitrix
        if ($request->isMethod('POST') && $request->request->get('PLACEMENT') == 'DEFAULT') {

            $result = $bitrixManagerService->install(
                $request->query->get('DOMAIN'),
                null,
                $request->request->get('member_id'),
                $request->request->get('AUTH_ID'),
                $request->request->get('REFRESH_ID'),
            );

            if ($result === true) {
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
            } else {
                $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            }
        } else {
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response;
    }
}