<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\AdminBundle\Form\UserImageType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, array(
                'label'=>'Nom',
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email', 
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation du mot de passe'),
                'invalid_message' => 'Mot de passe différent',
            ))
            ->add('userImage', UserImageType::class, array(
                 'label'=>false,
                 'required' => false,
            ))
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Administrateur' => 'ROLE_ADMIN',
                    'Partenaire' => 'ROLE_ADMIN',
                    'Client' => 'ROLE_CLIENT',
                    ),
                'label'=>"Roles",
                'multiple'=>true,
            ));

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
