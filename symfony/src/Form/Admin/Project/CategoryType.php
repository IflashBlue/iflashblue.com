<?php

namespace App\Form\Admin\Project;

use App\Entity\Project\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class CategoryType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('order', NumberType::class, [
                'label' => 'admin.category.order',
                'required' => false,
                'attr' => [
                    'min' => 0,
                    'step' => 1,
                ],
                'constraints' => [
                    new PositiveOrZero(),
                ],
            ])
            ->add('translations', CollectionType::class, [
                'entry_type' => CategoryTranslationType::class,
                'allow_add' => false,
                'allow_delete' => false,
                'label' => 'admin.translations.translation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
