<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lannonce','textarea',array('attr' => array('class' => 'tinymce','tinymce'=>'{"theme":"simple"}','cols' => "70", 'rows' => "15"),'label' => 'Annonce'))
            ->add('debut','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Début',
                          'format' => 'dd/MM/yyyy'))
            ->add('fin','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Fin',
                          'format' => 'dd/MM/yyyy'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\ParnalBundle\Entity\Annonce'
        ));
    }

    public function getName()
    {
        return 'site_parnalbundle_annoncetype';
    }
}
