<?php

namespace App\Controller\Test;

use App\Entity\Bitrix;
use App\Service\Bitrix\BuilderCoreService;
use App\Service\Bitrix\Entity\EntityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TestInstallController extends AbstractController
{

    #[Route('/test/install', 'test_install')]
    public function index(Request $request, EntityManagerInterface  $entityManager): JsonResponse
    {
        $request->request->set('member_id', 'fc91abad728a1af85e86eff3d1e2424f');

        $memberId = $request->request->get('member_id');

        $bitrix = $entityManager->getRepository(Bitrix::class)->get($memberId);

        // ? hash tokens
        


        if (!$bitrix) {
            $entityManager->getRepository(Bitrix::class)->set('test', 'free', $memberId, 'fdsfsdrewrwe', 'dsadasdas', 102341023);
        }

        $client = $bitrix->getClient();

        return new JsonResponse([
            'memberId' => $memberId,
            'class' => $bitrix::class,
            'client' => $client->getAccessToken()
        ]);
    }
}