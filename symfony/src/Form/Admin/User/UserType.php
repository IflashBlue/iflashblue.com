<?php

namespace App\Form\Admin\User;

use App\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           ->add('username', TextType::class, [
               'label' => 'admin.users.username',
               'constraints' => [
                   new NotBlank(),
               ],
           ])
           ->add('email', EmailType::class, [
               'label' => 'admin.users.email',
               'constraints' => [
                   new Email(),
                   new NotBlank(),
               ],
           ])
            ->add('firstname', TextType::class, [
                'label' => 'admin.users.firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'admin.users.lastname',
            ])
            ->add('file', FileType::class, [
                'label' => 'admin.users.image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/*',
                        ],
                    ]),
                ],
            ])
            ->add('translations', CollectionType::class, [
                'entry_type' => UserTranslationType::class,
                'allow_add' => false,
                'allow_delete' => false,
                'label' => 'admin.translations.translation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
