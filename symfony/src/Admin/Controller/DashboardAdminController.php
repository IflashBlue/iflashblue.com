<?php

namespace App\Admin\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardAdminController extends AbstractAdminController
{
    #[Route(path: '/', name: 'admin_index', methods: ['GET'])]
    public function dashboard(): Response
    {
        return $this->render('views/admin/dashboard/index.html.twig', [
        ]);
    }
}
