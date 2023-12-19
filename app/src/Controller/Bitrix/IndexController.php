<?php

namespace App\Controller\Bitrix;

use App\Service\Bitrix\{
    BuilderCoreService,
    Entity\TestEnityService
};
use Symfony\Component\HttpFoundation\{Request, Response};
use Bitrix24\SDK\Core\Core;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private Core $core;
    private Logger $logger;

    // #[Route('/', name: 'main')]
    public function execute(Request $request, BuilderCoreService $builderCoreService): Response
    {
        // ? Test
        // Set member_id
        $request->request->set('member_id', 'fc91abad728a1af85e86eff3d1e2424f');

        try {
            // Create core
            $this->core = $builderCoreService->getCore($request->request->get('member_id'));
            $this->logger = $builderCoreService->getLogger();

            // $storage = new TestEnityService($this->core, $this->logger);
            // $result = $storage->getEntity();
            // $message = $result;
            $message = ['test'];

        } catch (\Exception $e) {
            $message = [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        } finally {
            // return new Response("
            // <html>
            //     <body>
            //         <pre>" . print_r($message, true) . "</pre>
            //     </body>
            // </html>"
            // );
        }

        // dump($request);

        return $this->render('settings/index.html.twig', [
            'controller_name' => 'BitrixIndexController',
        ]);
    }
}
