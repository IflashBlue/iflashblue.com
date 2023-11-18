<?php

namespace App\Admin\Form\Configuration;

use App\Admin\Entity\Configuration\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class MaintenanceType extends AbstractType
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
            ->add('maintenance', ChoiceType::class, [
                'label' => 'admin.configuration.maintenance',
                'required' => true,
                'choices' => [
                    $this->trans->trans('app.boolean.true') => true,
                    $this->trans->trans('app.boolean.false') => false,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}
