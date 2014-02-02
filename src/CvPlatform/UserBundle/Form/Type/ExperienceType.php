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
            ->add(
                'startDate',
                'date',
                array(
                    'years' => range(1950,2014),
                    'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                    'horizontal_input_wrapper_class' => 'col-lg-3',
                    'widget' => 'choice',
                )
            )
            ->add(
                'endDate',
                'date',
                array(
                    'years' => range(1950,2014),
                    'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                    'horizontal_input_wrapper_class' => 'col-lg-3',
                    'widget' => 'choice',
                )
            )
            ->add('content', 'textarea')
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
        return 'add_professionnal_experiences';
    }
}
