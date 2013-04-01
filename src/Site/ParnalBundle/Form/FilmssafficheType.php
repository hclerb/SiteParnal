<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilmssafficheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_sortie','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Date de sortie',
                          'format' => 'dd/MM/yyyy'))  
            ->add('provenance','choice', array('label' => 'Provenance','choices'=> array(0=>'France', 1=>'USA',2=>'Europe',3=>'Reste du monde'))) 
            ->add('artessai', 'checkbox', array('label' => 'Art et Essai','required' => false))
            ->add('labjp', 'checkbox', array('label' => 'Jeune Public','required' => false))
            ->add('labrecherche', 'checkbox', array('label' => 'Recherche','required' => false))
            ->add('labpatrimoine', 'checkbox', array('label' => 'Patrimoine','required' => false))
            ->add('copieadrc', 'checkbox', array('label' => 'Copie Adrc','required' => false))               
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\ParnalBundle\Entity\Film'
        ));
    }

    public function getName()
    {
        return 'site_parnalbundle_filmssaffichetype';
    }
}
