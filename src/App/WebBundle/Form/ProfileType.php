<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;
use App\AdminBundle\Form\UserImageType;
use App\WebBundle\Form\ClientType;
use App\WebBundle\Form\PartenaireType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ProfileType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email', 
                'translation_domain' => 'FOSCoreBundle',
            ));


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $user = $this->tokenStorage->getToken()->getUser();

                if($user->hasRole('ROLE_CLIENT')) {
                     $form
                        ->add('client', ClientType::class, [
                                'label' => false
                            ]);                   
                }

                if($user->hasRole('ROLE_PARTENAIRE')) {
                     $form
                        ->add('partenaire', PartenaireType::class, [
                                'label' => false
                            ]);                     
                }

                if($user->hasRole('ROLE_ADMIN') || $user->hasRole('ROLE_SUPER_ADMIN')){
                    $form
                        ->add('lastName', TextType::class, [
                            'label'=>'Nom',
                        ])
                        ->add('userImage', UserImageType::class, [
                             'label'=>'Photo de profil',
                             'required' => false,
                        ]);
                }
            }
        ); 
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'mot de passe invalide',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', PasswordType::class, array(
            'label' => 'Mot de passe actuel',
            'translation_domain' => 'FOSCoreBundle',
            'mapped' => false,
            'constraints' => array(
                new NotBlank(),
                new UserPassword($constraintsOptions),
            ),
            'attr' => array(
                'autocomplete' => 'current-password',
            ),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Utilisateur',
            'csrf_token_id' => 'profile',
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}
