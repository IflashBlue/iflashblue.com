<?php

namespace App\Site\Controller;

use App\Admin\Entity\Configuration\Configuration;
use App\Admin\Entity\Configuration\ConfigurationTranslation;
use App\Admin\Service\Contact\ContactService;
use App\Form\Contact\ContactType;
use App\Site\Model\ContactModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/{_locale}/contact', requirements: ['_locale' => 'fr|en'])]
class ContactController extends AbstractSiteController
{
    #[Route(name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(
        Request $request,
        ContactService $contactService
    ): Response {
        /** @var Configuration $configuration */
        $configuration = $this->configurationRepository->findOneBy([]);
        /** @var ConfigurationTranslation|null $translation */
        $translation = $configuration->getTranslation($this->request->getLocale());

        $model = new ContactModel();

        $form = $this->createForm(ContactType::class, $model);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (true === $contactService->send($model, $this->request->getLocale())) {
                $this->addFlash('success', $this->translator->trans('app.form.contact.success'));
            } else {
                $this->addFlash('error', $this->translator->trans('app.form.contact.error'));
            }
        }

        return $this->render('views/contact/index.html.twig', [
            'form' => $form->createView(),
            'configuration' => $translation,
        ]);
    }
}
