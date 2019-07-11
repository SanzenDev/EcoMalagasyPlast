<?php

namespace Portfolio\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste', TextType::class, [
                'label'=>'Poste',
            ])
            ->add('duree', TextType::class, [
                'label'=>'Durée',
            ])
             ->add('link', TextType::class, [
                'label'=>'Lien',
                'required'=>false,
                'attr'=>['value'=>'http://'],
            ])
            ->add('society', TextType::class, [
                'label'=>'Société',
                'required'=>false,
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Description',
                'required'=>false,
                'attr'=>['rows'=>30],
            ])
           ->add('logo', ImageType::class, [
                 'label'=>'Logo de la société',
                'required'=>false,
            ])   
           ->add('fichier', FichierType::class, [
                 'label'=>'Fichier',
                 'required'=>false,
            ])  
            ->add('images', CollectionType::class, [
                    'entry_type' => ImageType::class,
                    'label'=>'Autres Images',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'required' => false,
                    'attr'=>array('class'=>'images-collection')
            ]);                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Portfolio\CoreBundle\Entity\Experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'portfolio_corebundle_experience';
    }


}
