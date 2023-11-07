<?php

namespace App\Controller\Admin;

use App\Entity\User\User;
use App\Form\Admin\User\PasswordResetType;
use App\Form\Admin\User\UserType;
use App\Model\PasswordResetModel;
use App\Repository\UserRepository;
use App\Service\Image\ImageUploadService;
use App\Service\User\ResetPasswordService;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/users')]
#[IsGranted('ROLE_ADMIN')]
class UserAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly UserRepository $userRepository)
    {
        parent::__construct($translator, $requestStack);
    }

    #[Route(path: '/', name: 'admin_users_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('views/admin/users/index.html.twig', [
            'users' => $this->userRepository->findAll(),
        ]);
    }

    #[Route(path: '/update/{id}', name: 'admin_users_update', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function update(
        ResetPasswordService $resetPasswordService,
        User $user,
        ImageUploadService $imageUploadService
    ): Response {
        // reset password
        $modelPassword = new PasswordResetModel();
        $formResetPassword = $this->createForm(PasswordResetType::class, $modelPassword);
        $formResetPassword->handleRequest($this->request);
        if ($formResetPassword->isSubmitted() && $formResetPassword->isValid()) {
            try {
                $resetPasswordService->reset($modelPassword->password, $user);
                $this->addFlash('success', $this->translator->trans('admin.users.reset_password_successful'));
            } catch (Exception) {
                $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
            }
        }
        // edit user form
        $formEditUser = $this->createForm(UserType::class, $user);
        $formEditUser->handleRequest($this->request);
        if ($formEditUser->isSubmitted() && $formEditUser->isValid()) {
            try {
                /** @var Form $dataForm */
                $dataForm = $formEditUser->get('file');
                /** @var UploadedFile|null $uploadedFile */
                $uploadedFile = $dataForm->getData();
                if ($uploadedFile instanceof UploadedFile) {
                    $path = $imageUploadService->upload($uploadedFile);
                    $user->setImage($path);
                }

                $this->userRepository->add($user, true);
                $this->addFlash('success', $this->translator->trans('admin.users.edit_successful'));
            } catch (Exception) {
                $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
            }
        }

        return $this->render('views/admin/users/update.html.twig', [
            'formResetPassword' => $formResetPassword->createView(),
            'formEditUser' => $formEditUser->createView(),
            'user' => $user,
        ]);
    }
}
