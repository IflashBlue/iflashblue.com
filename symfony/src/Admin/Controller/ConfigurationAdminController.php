<?php

namespace App\Admin\Controller;

use App\Admin\Entity\Configuration\Configuration;
use App\Admin\Form\Configuration\MaintenanceType;
use App\Admin\Repository\ConfigurationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/configuration')]
#[IsGranted('ROLE_ADMIN')]
class ConfigurationAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly ConfigurationRepository $configurationRepository
    ) {
        parent::__construct($translator, $requestStack);
    }

    #[Route(path: '/maintenance', name: 'admin_configuration_maintenance', methods: ['GET', 'POST'])]
    public function maintenance(): Response
    {
        /** @var Configuration $configuration */
        $configuration = $this->configurationRepository->findOneBy([]);

        $form = $this->createForm(MaintenanceType::class, $configuration);

        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->configurationRepository->add($configuration, true);
            $this->addFlash('success', $this->translator->trans('admin.actions.success'));
        }

        return $this->render('views/admin/configuration/maintenance.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
