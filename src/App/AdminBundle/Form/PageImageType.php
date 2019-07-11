<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PageImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', VichFileType::class, array(
                'label' => 'Image',
            ))
            ->add('legend', TextType::class, array(
                'label' => 'Légende de la photo',
                'required' => false
            ))
            ->add('cover', CheckboxType::class, [
                'label'=>"Afficher comme image de couverture",
                'attr'=>['checked'=>'checked', 'class'=> 'peer pL-15'],
                'label_attr'=>['class'=> 'peers peer-greed js-sb ai-c'],
                'required' => false
           ])
           ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\CoreBundle\Entity\PageImage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_corebundle_pageimage';
    }


}
