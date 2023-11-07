<?php

namespace App\Controller\Admin;

use App\Entity\Project\Project;
use App\Entity\Project\ProjectImage;
use App\Entity\Project\ProjectTranslation;
use App\Enum\LocaleEnum;
use App\Form\Admin\Project\ProjectType;
use App\Repository\ProjectRepository;
use App\Service\Image\ImageUploadService;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/projects')]
#[IsGranted('ROLE_ADMIN')]
class ProjectAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly ProjectRepository $projectRepository)
    {
        parent::__construct($translator, $requestStack);
    }

    #[Route(path: '/', name: 'admin_projects_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('views/admin/projects/index.html.twig', [
            'projects' => $this->projectRepository->findBy([], ['order' => 'ASC']),
        ]);
    }

    #[Route(path: '/update/{id}', name: 'admin_projects_update', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function update(
        Project $project,
        ImageUploadService $imageUploadService
    ): Response {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->saveImages($form, $imageUploadService, $project);
                $this->projectRepository->add($project, true);
                $this->addFlash('success', $this->translator->trans('admin.project.edit_successful'));
            } catch (Exception) {
                $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
            }
        }

        return $this->render('views/admin/projects/update.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route(path: '/new', name: 'admin_projects_create', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function create(
        ImageUploadService $imageUploadService
    ): Response {
        $project = new Project();
        $project->addTranslation(new ProjectTranslation(LocaleEnum::FR));
        $project->addTranslation(new ProjectTranslation(LocaleEnum::EN));

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($this->request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->saveImages($form, $imageUploadService, $project);
                $this->projectRepository->add($project, true);
                $this->addFlash('success', $this->translator->trans('admin.actions.success'));

                return $this->redirectToRoute('admin_projects_update', ['id' => $project->getId()]);
            } catch (Exception) {
                $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
            }
        }

        return $this->render('views/admin/projects/create.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'admin_projects_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Project $project): Response
    {
        try {
            $this->projectRepository->remove($project, true);
            $this->addFlash('success', $this->translator->trans('admin.project.project_deleted'));
        } catch (Exception) {
            $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
        }

        return $this->redirectToRoute('admin_projects_index');
    }

    public function saveImages(FormInterface $form, ImageUploadService $imageUploadService, Project $project): void
    {
        /** @var ArrayCollection $collection */
        $collection = $form->get('images')->getData();
        /**
         * @var string       $key
         * @var ProjectImage $row
         */
        foreach ($collection as $key => $row) {
            /** @var UploadedFile|null $uploadedFile */
            $uploadedFile = $form->get('images')->get($key)->get('image')->getData();
            if ($uploadedFile instanceof UploadedFile) {
                $path = $imageUploadService->upload($uploadedFile);
                $row->setImage($path);
            }
        }
    }
}
