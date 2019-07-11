<?php

namespace App\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label'=>' ',
                'required'=> false,
                'attr'  => ['placeholder'  => 'Votre Prénom']
            ])
            ->add('lastName', TextType::class, [
                'label'=>' ',
                'attr'  => ['placeholder'  => 'Votre Nom']
                'required'=> false,
            ])
            ->add('email', EmailType::class, [
                'label' => ' ', 
                'translation_domain' => 'FOSUserBundle',
                'attr'  => ['placeholder'  => 'Votre e-mail']
            ])
            ->add('username', null, [
                'label' => ' ', 
                'translation_domain' => 'FOSUserBundle',
                'attr'  => ['placeholder'  => 'Votre Pseudo']
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['autocomplete' => 'new-password']
                ],
                'first_options' => [
                    'label' => ' ',
                    'attr'  => ['placeholder'  => 'Votre mot de passe']
                ],
                'second_options' => [
                    'label' => ' ',
                    'attr'  => ['placeholder'  => 'Confirmation du mot de passe']
                ],
                'invalid_message' => 'Mot de passe différent',
            ])
            ->add('userImage', UserImageType::class, [
                 'label'=>' ',
                 'required' => false,
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Utilisateur'
        ));
    }

    /**
     * {@inheritdoc}
     */
/*    public function getBlockPrefix()
    {
        return 'biblio_userbundle_user';
    }*/
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
