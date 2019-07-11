<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class ContactType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'label'=>'Sujet',
            ])
            ->add('message', TextareaType::class, [
                'label'=>'Message',
            ]);  

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $user = $this->tokenStorage->getToken()->getUser();

                if(!is_null($user)) {
                     $form
                        ->add('name', TextType::class, ['label'=>'Nom'])
                        ->add('email', EmailType::class, [
                            'label'=>'Email',
                            'attr' => ['placeholder' => 'ex: jeandupont@mail.fr'],
                        ]);                   
                } else {
                     $form
                        ->add('name', TextType::class, [
                            'label'=>'Nom',
                            'attr' => ['value' => $user->getUsername()]
                        ])
                        ->add('email', EmailType::class, [
                            'label'=>'Email',
                            'attr' => ['value' => $user->getEmail()],
                        ]);                     
                }
            }
        );                 
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_corebundle_contact';
    }


}
