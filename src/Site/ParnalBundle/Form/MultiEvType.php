<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MultiEvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('pitch','textarea', array('attr' => array('class' => 'tinymce','tinymce'=>'{"theme":"simple"}','cols' => "70", 'rows' => "15")))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\ParnalBundle\Entity\MultiEv'
        ));
    }

    public function getName()
    {
        return 'site_parnalbundle_multievtype';
    }
}
