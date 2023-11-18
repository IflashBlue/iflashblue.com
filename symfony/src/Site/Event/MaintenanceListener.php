<?php

namespace App\Site\Event;

use App\Admin\Entity\Configuration\Configuration;
use App\Admin\Entity\User\User;
use App\Admin\Repository\ConfigurationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\UsageTrackingTokenStorage;
use Twig\Environment;

class MaintenanceListener
{
    public function __construct(
        readonly private Environment $twig,
        private readonly ConfigurationRepository $repository,
        private readonly UsageTrackingTokenStorage $tokenStorage
    ) {
    }

    public function onKernelRequest(KernelEvent $event): void
    {
        if (!$event->isMainRequest()) {
            // don't do anything if it's not the main request
            return;
        }

        /** @var User|null $user */
        $user = $this->tokenStorage->getToken()?->getUser();

        if ($user instanceof User || 'admin_login' === $event->getRequest()->attributes->get('_route')) {
            // if admin user is logged in or if we are on login page don't throw maintenance mode
            return;
        }

        /** @var Configuration $configuration */
        $configuration = $this->repository->findOneBy([]);

        if (true === $configuration->isMaintenance()) {
            $page = $this->twig->render('views/maintenance/maintenance.html.twig');
            /* @phpstan-ignore-next-line */
            $event->setResponse(
                new Response(
                    $page,
                    Response::HTTP_SERVICE_UNAVAILABLE
                )
            );
            $event->stopPropagation();
        }
    }
}
