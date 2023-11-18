<?php

namespace App\Form\Contact;

use App\Site\Model\ContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactType extends AbstractType
{
    public function __construct(readonly private TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.form.contact.fields.name',
                'attr' => [
                    'placeholder' => strtoupper($this->translator->trans('app.form.contact.fields.name')),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'app.form.contact.fields.email',
                'attr' => [
                    'placeholder' => strtoupper($this->translator->trans('app.form.contact.fields.email')),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'app.form.contact.fields.message',
                'attr' => [
                    'rows' => 10,
                    'placeholder' => strtoupper($this->translator->trans('app.form.contact.fields.message')),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'app.form.contact.fields.submit',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactModel::class,
        ]);
    }
}
