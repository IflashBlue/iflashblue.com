<?php

namespace App\Form\Admin\Project;

use App\Entity\Project\Category;
use App\Entity\Project\CategoryTranslation;
use App\Entity\Project\Project;
use App\Enum\LocaleEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProjectType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $trans)
    {
    }

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
            ->add('highlight', ChoiceType::class, [
                'label' => 'admin.project.highlight',
                'required' => true,
                'choices' => [
                    $this->trans->trans('app.boolean.true') => true,
                    $this->trans->trans('app.boolean.false') => false,
                ],
            ])
            ->add('category', EntityType::class, [
                'label' => 'admin.category.category',
                'required' => true,
                'class' => Category::class,
                'choice_label' => function (Category $cat) {
                    /** @var CategoryTranslation|null $trans */
                    $trans = $cat->getTranslation(LocaleEnum::FR->value);

                    return $trans?->getTitle();
                },
            ])
            ->add('translations', CollectionType::class, [
                'entry_type' => ProjectTranslationType::class,
                'allow_add' => false,
                'allow_delete' => false,
                'label' => 'admin.translations.translation',
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ProjectImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'admin.project.images',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
