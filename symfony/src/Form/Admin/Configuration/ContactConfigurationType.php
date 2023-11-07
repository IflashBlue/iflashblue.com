<?php

namespace App\Form\Admin\Configuration;

use App\Entity\Configuration\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactConfigurationType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', CollectionType::class, [
                'entry_type' => ContactTranslationConfigurationType::class,
                'allow_add' => false,
                'allow_delete' => false,
                'label' => 'admin.translations.translation',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}
