<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DechetPartenaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', TextType::class, [
                'label'=>'Quantité',
            ])
            ->add('enabled', CheckboxType::class, [
                'label'=>"Publier?",
                'attr'=>['checked'=>'checked', 'class'=> 'peer'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
           ])
            ->add('partenaire', EntityType::class, [
                'label' => 'Sélectionnez le partenaire', 
                'multiple' => false,
                'required' => false, 
                'attr' => ['class' => 'form-control' ,'data-placeholder' => 'Sélectionnez...'], 
                'class' => 'AppCoreBundle:Partenaire', 'choice_label' => 'name'
            ])
        ;                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\DechetPartenaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_adminbundle_dechetpartenaire';
    }


}
