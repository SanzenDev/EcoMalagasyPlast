<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\WebBundle\Form\UtilisateurImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email', 
            ))
            ->add('lastName', TextType::class, array(
                'label'=>'Nom',
                'required'=> false,
            ))
            ->add('userImage', UtilisateurImageType::class, array(
                 'label'=>'Photo de profil',
                 'required' => false,
            ))
            ->add('password', TextType::class, array(
                 'label'=>'Mot de passe',
                 'required' => false,
            ))
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Administrateur' => 'ROLE_ADMIN',
                    'Partenaire' => 'ROLE_PARTENAIRE',
                    'Client' => 'ROLE_CLIENT',
                    ),
                'label'=>"Roles",
                'multiple'=>true,
            ));
    }

    /**
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
