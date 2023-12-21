<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\BitrixRepository;

use Symfony\Component\HttpFoundation\{
    Request,
    Response
};

class InstallController extends AbstractController
{
    #[Route('/install', name: 'install')]
    public function install(Request $request): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/html');

        try {
            // $bitrix->set();

        } catch (\Throwable $th) {
            $response->setContent($th->getMessage());
        }

        // Check type of request and that a request from the Bitrix
        if ($request->isMethod('POST') && $request->request->get('PLACEMENT') == 'DEFAULT') {
            if ($bitrix->set('domain', null, 'fc91abad728a1af85e86eff3d1e2424f', 'accessToken', 'refreshToken', 1234324)) {
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

        dd($request);
        return $response;
    }
}