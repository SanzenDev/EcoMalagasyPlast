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
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class NewsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Titre',
                'attr' => ['placeholder'=>"Titre"]
            ])
            ->add('content',  CKEditorType::class, [
                'config_name' => 'main_config',
                'label'=>'Contenu',
                'required'=>false,
            ])
             ->add('youtube',  TextType::class, [
                'label'=>'Lien Youtube',
                'required'=>false,
            ])
            ->add('enabled', CheckboxType::class, [
                'label'=>"Publier?",
                'attr'=>['checked'=>'checked', 'class'=> 'peer'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
           ])
           ->add('newsImage', NewsImageType::class, [
                 'label'=>false,
            ])  
           ->add('newsVideoMp4', NewsVideoMp4Type::class, [
                 'label'=>'Video Mp4',
                 'required'=>false,
            ])  
           ->add('newsVideoOgg', NewsVideoOggType::class, [
                 'label'=>'Video Ogg',
                 'required'=>false,
            ])  
           ->add('newsVideoWebm', NewsVideoWebmType::class, [
                 'label'=>'Video Webm',
                 'required'=>false,
            ])  
           ->add('newsPdf', NewsPdfType::class, [
                 'label'=>'PDF',
                 'required'=>false,
            ])  
           ->add('newsZip', NewsZipType::class, [
                 'label'=>'PDF',
                 'required'=>false,
            ])  
            ->add('metaTitle', TextType::class, array(
                'required'=>false,
                'label'=>'Méta Titre',
            ))
            ->add('metaDescription', TextType::class, array(
                'required'=>false,
                'label'=>'Méta Description',
            ))
            ->add('metaKeywords', TextType::class, array(
                'required'=>false,
                'label'=>'Mot Clés',
            ))
            ->add('newsOtherImages', CollectionType::class, [
                    'entry_type' => NewsOtherImagesType::class,
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
            'data_class' => 'App\CoreBundle\Entity\News'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_adminbundle_news';
    }


}
