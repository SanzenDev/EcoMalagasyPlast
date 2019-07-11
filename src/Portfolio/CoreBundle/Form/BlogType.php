<?php

namespace Portfolio\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Titre',
            ])
             ->add('tags', TextType::class, [
                'label'=>'Tags',
                'required'=>false,
            ])
            ->add('content',  CKEditorType::class, [
                'config_name' => 'main_config',
                'label'=>'Contenu',
                'required'=>false,
            ])
           ->add('image', ImageType::class, [
                 'label'=>'Image',
                'required'=>false,
            ]);                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Portfolio\CoreBundle\Entity\Blog'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'portfolio_corebundle_blog';
    }


}
