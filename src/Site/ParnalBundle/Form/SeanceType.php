<?php

namespace Site\ParnalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour','date',
                    array('widget' => 'single_text',                     
                          'label' => 'Jour',
                          'format' => 'dd/MM/yyyy'))
            ->add('heure','time',
                    array('widget' => 'choice',
                          'label' => 'Heure')) 
            ->add('lefilm','entity', 
                    array('label' => 'Film',
                          'class' => 'SiteParnalBundle:Film',
                          'query_builder' => function(\Site\ParnalBundle\Entity\FilmRepository $er) {
                                              return $er->createQueryBuilder('f') 	 
                                                        ->where('f.actif = 1')
                                                        ->orderBy('f.titre','ASC');})) 
            ->add('lemulti','entity',
                    array('label' => 'Fait partie de',
                        'class' => 'SiteParnalBundle:MultiEv',  
                        'required' => 'false'))
            ->add('scolaire', 'checkbox', array('required' => false))
            ->add('vo', 'checkbox', array('required' => false))
            ->add('relief', 'checkbox', array('required' => false))
            ->add('argentique', 'checkbox', array('required' => false))
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
        return 'site_parnalbundle_seancetype';
    }
}
