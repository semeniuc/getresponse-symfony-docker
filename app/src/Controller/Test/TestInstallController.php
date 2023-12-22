<?php

namespace App\Controller\Test;

use App\Entity\Client;
use App\Entity\Bitrix;
use App\Repository\ClientRepository;
use App\Repository\BitrixRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Routing\Annotation\Route;


class TestInstallController extends AbstractController
{
    public function __construct(private ClientRepository $clientRepository, private BitrixRepository $bitrixRepository) {}

    #[Route('/test/install', 'test_install')]
    public function index(Request $request): JsonResponse
    {
        $request->request->set('member_id', 'fc91abad728a1af85e86eff3d1e2424f');
        $memberId = $request->request->get('member_id');

        $bitrix = $this->bitrixRepository->get($memberId);
        if (!$bitrix) {
            // Create client
            $this->clientRepository->add('accessToken');
            $client = $this->clientRepository->get('accessToken');

            // Create bitrix
            $this->bitrixRepository->add($client, 'domainUrl', 'free', $memberId, 'accessToken', 'refreshToken', 102341023);
            $bitrix = $this->bitrixRepository->get($memberId);

            $client = $bitrix->getClient();
        } else {
            $client = $bitrix->getClient();
        }

        // dd($client, $bitrix);

        return new JsonResponse([
            'memberId' => $memberId,
        ]);
    }
}