<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DechetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Type',
                'attr' => ['placeholder'=>"Type du déchet"]
            ])
            ->add('amount', TextType::class, [
                'label'=>'Quantité',
                'attr' => ['placeholder'=>"Quantité du déchet"]
            ])
            ->add('enabled', CheckboxType::class, [
                'label'=>"Publier?",
                'attr'=>['checked'=>'checked', 'class'=> 'peer'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
           ])
            ->add('description', TextareaType::class, [
                'label'=>"Description",
                'required' => false,
           ])
           ->add('dechetImage', DechetImageType::class, [
                 'label'=>'Image',
            ])
        ;                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\Dechet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_adminbundle_dechet';
    }


}
