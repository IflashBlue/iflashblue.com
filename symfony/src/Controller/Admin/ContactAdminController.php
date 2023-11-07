<?php

namespace App\Controller\Admin;

use App\Entity\Configuration\Configuration;
use App\Form\Admin\Configuration\ContactConfigurationType;
use App\Repository\ConfigurationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/contact')]
#[IsGranted('ROLE_ADMIN')]
class ContactAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly ConfigurationRepository $configurationRepository
    ) {
        parent::__construct($translator, $requestStack);
    }

    #[Route(path: '/', name: 'admin_configuration_contact', methods: ['GET', 'POST'])]
    public function maintenance(): Response
    {
        /** @var Configuration $configuration */
        $configuration = $this->configurationRepository->findOneBy([]);

        $form = $this->createForm(ContactConfigurationType::class, $configuration);

        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->configurationRepository->add($configuration, true);
            $this->addFlash('success', $this->translator->trans('admin.actions.success'));
        }

        return $this->render('views/admin/configuration/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
