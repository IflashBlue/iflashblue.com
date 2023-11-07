<?php

namespace App\Controller\Admin;

use App\Entity\Home\Home;
use App\Form\Admin\Home\HomeType;
use App\Repository\HomeRepository;
use App\Service\Image\ImageUploadService;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/home')]
#[IsGranted('ROLE_ADMIN')]
class HomeAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly HomeRepository $homeRepository)
    {
        parent::__construct($translator, $requestStack);
    }

    #[Route(path: '/update', name: 'admin_home_update', methods: ['GET', 'POST'])]
    public function update(
        ImageUploadService $imageUploadService
    ): Response {
        /** @var Home $home */
        $home = $this->homeRepository->findOneBy([]);

        $form = $this->createForm(HomeType::class, $home);
        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var Form $dataForm */
                $dataForm = $form->get('file');
                /** @var UploadedFile|null $uploadedFile */
                $uploadedFile = $dataForm->getData();
                if ($uploadedFile instanceof UploadedFile) {
                    $path = $imageUploadService->upload($uploadedFile);
                    $home->setImage($path);
                }

                $this->homeRepository->add($home, true);
                $this->addFlash('success', $this->translator->trans('admin.home.update_successful'));
            } catch (Exception) {
                $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
            }
        }

        return $this->render('views/admin/home/update.html.twig', [
            'form' => $form->createView(),
            'home' => $home,
        ]);
    }
}
