<?php

namespace App\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom de la société',
            ])
            ->add('tel', TextType::class, [
                'label'=>'Numéro de téléphone',
                'attr'=>['placeholder'=> 'ex: +261330000000'],               
            ])
            ->add('address', TextType::class, [
                'label'=>'Adresse',
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
            ->add('showed', CheckboxType::class, [
                'label'=>"Afficher mes informations sur le site",
                'attr'=>['checked'=>'checked', 'class'=> 'peer mR-10'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
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
        return 'app_webbundle_client';
    }


}
