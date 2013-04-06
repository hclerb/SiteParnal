<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation','textarea', array('attr' => array('class' => 'tinymce','tinymce'=>'{"theme":"simple"}','cols' => "70", 'rows' => "15")))
            ->add('fichier','text', 
                    array('read_only' => 'true'))
            ->add('file','file')
            ->add('finaffichage','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Date de sortie',
                          'format' => 'dd/MM/yyyy'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\ParnalBundle\Entity\Programme'
        ));
    }

    public function getName()
    {
        return 'site_parnalbundle_programmetype';
    }
}
