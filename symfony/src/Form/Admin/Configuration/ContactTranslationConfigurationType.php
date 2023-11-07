<?php

namespace App\Form\Admin\Configuration;

use App\Entity\Configuration\ConfigurationTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class ContactTranslationConfigurationType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'admin.configuration.city',
            ])
            ->add('email', EmailType::class, [
                'label' => 'admin.configuration.email',
                'constraints' => [
                    new Email(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigurationTranslation::class,
        ]);
    }
}
