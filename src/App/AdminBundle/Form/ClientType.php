<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom',
                'attr' => ['placeholder'=>"Nom de la société"]
            ])
            ->add('tel', TextType::class, [
                'label'=>'Téléphone',
                'attr' => ['placeholder'=>"ex: +261345678910"]
            ])
            ->add('address', TextType::class, [
                'label'=>'Adresse',
                'attr' => ['placeholder'=>"Adresse de la société"],
                 'required'=>false,
            ])
            ->add('enabled', CheckboxType::class, [
                'label'=>"Publier?",
                'attr'=>['checked'=>'checked', 'class'=> 'peer'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
           ])
            ->add('nif', TextType::class, [
                'label'=>'NIF',
                'required'=>false               
            ])
            ->add('rce', TextType::class, [
                'label'=>'RCE',
                'required'=>false               
            ])
            ->add('stat', TextType::class, [
                'label'=>'STAT',
                'required'=>false               
            ])
;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_adminbundle_client';
    }


}
