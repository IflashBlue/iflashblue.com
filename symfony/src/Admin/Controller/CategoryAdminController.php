<?php

namespace App\Admin\Controller;

use App\Admin\Enum\LocaleEnum;
use App\Admin\Repository\CategoryRepository;
use App\Admin\Entity\Project\Category;
use App\Admin\Entity\Project\CategoryTranslation;
use App\Admin\Form\Project\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route(path: '/admin/categories')]
#[IsGranted('ROLE_ADMIN')]
class CategoryAdminController extends AbstractAdminController
{
    public function __construct(
        TranslatorInterface $translator,
        RequestStack $requestStack,
        private readonly CategoryRepository $categoryRepository
    ) {
        parent::__construct($translator, $requestStack);
    }

    #[Route(name: 'admin_category_index', methods: ['GET'])]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findBy([], ['order' => 'ASC']);

        return $this->render('views/admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route(path: '/new', name: 'admin_category_new', methods: ['GET', 'POST'])]
    public function create(): Response
    {
        $category = new Category();
        $category->addTranslation(new CategoryTranslation(LocaleEnum::FR));
        $category->addTranslation(new CategoryTranslation(LocaleEnum::EN));

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryRepository->add($category, true);
            $this->addFlash('success', $this->translator->trans('admin.actions.success'));
        }

        return $this->render('views/admin/category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'admin_category_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($this->request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryRepository->add($category, true);
            $this->addFlash('success', $this->translator->trans('admin.actions.success'));
        }

        return $this->render('views/admin/category/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/delete/{id}', name: 'admin_category_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Category $category): Response
    {
        try {
            $this->categoryRepository->remove($category, true);
            $this->addFlash('success', $this->translator->trans('admin.category.category_deleted'));
        } catch (\Exception) {
            $this->addFlash('danger', $this->translator->trans('admin.errors.occurred'));
        }

        return $this->redirectToRoute('admin_category_index');
    }
}
