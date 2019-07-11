<?php

namespace Mia\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Mia\CoreBundle\Form\UserImageType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileType extends AbstractType
{
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
                'attr'  => array(
                    'class'  => 'form-control',
                    'placeholder'  => 'Email'
                )
            ))
            ->add('firstName', TextType::class, array(
                'label'=>'Prénoms',
                'required'=> false,
                'attr'  => array(
                    'class'  => 'form-control',
                    'placeholder'  => 'Prénoms'
                )
            ))
            ->add('lastName', TextType::class, array(
                'label'=>'Nom',
                    'attr'  => array(
                        'class'  => 'form-control',
                        'placeholder'  => 'Nom'
                    )
            ))
            ->add('userImage', UserImageType::class, array(
                 'label'=>'Votre photo',
                 'required' => false,
            ));
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
            'data_class' => 'Mia\CoreBundle\Entity\User',
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
