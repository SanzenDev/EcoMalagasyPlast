<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\AdminBundle\Form\UserImageType;


class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('email', EmailType::class, [
                'label' => 'Adresse E-mail', 
                'translation_domain' => 'FOSUserBundle',
            ])
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur', 
                'translation_domain' => 'FOSUserBundle',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => ['autocomplete' => 'new-password'],                   
                ],
                'first_options' => [
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                ],
                'invalid_message' => 'Mot de passe différent',
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Partenaire' => 'ROLE_PARTENAIRE',
                    'Client' => 'ROLE_CLIENT',
                ],
                'multiple'=>true,
                'expanded' => true,
                'required' => false,
                'label' => false,
                'attr'=>['class'=> 'mL-15'],
                // 'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c']
            ]);
;
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
