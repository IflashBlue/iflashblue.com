<?php

namespace App\Admin\Service\Contact;

use App\Admin\Entity\Configuration\Configuration;
use App\Admin\Entity\Configuration\ConfigurationTranslation;
use App\Admin\Repository\ConfigurationRepository;
use App\Site\Model\ContactModel;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactService
{
    public function __construct(
        private readonly ConfigurationRepository $configurationRepository,
        private readonly TranslatorInterface $trans,
        private readonly MailerInterface $mailer,
    ) {
    }

    public function send(ContactModel $model, string $locale): bool
    {
        /** @var Configuration $configuration */
        $configuration = $this->configurationRepository->findOneBy([]);

        /** @var ConfigurationTranslation $translation */
        $translation = $configuration->getTranslation($locale);

        /** @var string $dest */
        $dest = $translation->getEmail();

        try {
            $templatedEmail = (new TemplatedEmail())
                ->from($model->email)
                ->to(new Address($dest))
                ->subject($this->trans->trans('app.email.contact.title', ['%name%' => $model->name], null, $locale))

                // path of the Twig template to render
                ->htmlTemplate('emails/contact.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'model' => $model,
                ]);

            $this->mailer->send($templatedEmail);

            return true;
        } catch (\Exception|TransportExceptionInterface) {
            return false;
        }
    }
}
