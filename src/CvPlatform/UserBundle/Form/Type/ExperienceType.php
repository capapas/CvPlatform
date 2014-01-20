<?php

namespace CvPlatform\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExperienceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('what', 'text')
            ->add('place', 'text')
            ->add('startDate', 'date')
            ->add('endDate', 'date')
            ->add('content', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CvPlatform\FrontBundle\Entity\Experience'
        ));
    }

    public function getName()
    {
        return 'cvplatform_userbundle_experiencetype';
    }
}
