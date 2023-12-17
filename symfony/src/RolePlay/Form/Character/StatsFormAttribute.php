<?php

namespace App\RolePlay\Form\Character;

use App\RolePlay\Entity\CharacterAttribute;
use App\RolePlay\Enum\AttributeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatsFormAttribute extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'role_play.attribute.type',
                'choices' => AttributeType::class,
                'choice_label' => fn(?AttributeType $type) => 'role_play.attribute' . $type->value,
                'choice_value' => fn(?AttributeType $type) => $type->value,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CharacterAttribute::class,
        ]);
    }
}