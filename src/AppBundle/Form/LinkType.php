<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du lien',
                'required' => true,
                'help_label' => 'Voici un message d\'aide',
            ])
            ->add('url', null, [
                'attr' => [
                    'novalidate' => true
                ],
                'help_block' => 'Ne partagez pas de liens facebook',
            ])
            ->add('category', EntityType::class, [
                'class' => 'AppBundle\Entity\Category',
                'property' => 'name'
            ])
            ->add('tags')
            ->add('author')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Link'
        ));
    }
}
