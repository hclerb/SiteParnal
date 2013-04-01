<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeanceentreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nbgratuits','text', array('label' => 'Entrées Gratuites'))
            ->add('nbpayants','text', array('label' => 'Entrées Payantes'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\ParnalBundle\Entity\Seance'
        ));
    }

    public function getName()
    {
        return 'site_parnalbundle_seanceentreetype';
    }
}
