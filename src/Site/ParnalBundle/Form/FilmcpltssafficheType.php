<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilmcpltssafficheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('realisateur')
            ->add('date_sortie','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Date de sortie',
                          'format' => 'dd/MM/yyyy'))                
            ->add('duree', 'text',array('required' => false))
	    ->add('provenance','choice', array('label' => 'Provenance','choices'=> array(0=>'France', 1=>'USA',2=>'Europe',3=>'Reste du monde'))) 
	    ->add('interdiction','choice', array('choices'=> array(0=>'Pas d\'interdiction', 1=>'-12 ans',2=>'-16 ans',3=>'-18 ans')))
	    ->add('conseille', 'choice', array('choices'=>array(0=>"Nothing",1=>'Adultes',2=>'Ado - Adultes',3=>'Ado',4=>'Famille',5=>'Jeune Public')))
            ->add('acteurs', 'text', array('required' => false))
            ->add('synopsis','textarea',array('attr' => array('class' => 'tinymce','tinymce'=>'{"theme":"simple"}','cols' => "70", 'rows' => "15",'required' => false)))
            ->add('critique','textarea', array('attr' => array('class' => 'tinymce','tinymce'=>'{"theme":"simple"}','cols' => "70", 'rows' => "15",'required' => false)))
            ->add('sourceimage', 'text', array('label' => 'Source images','required' => false)) 
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
        return 'site_parnalbundle_filmcpltssaffichetype';
    }
}
