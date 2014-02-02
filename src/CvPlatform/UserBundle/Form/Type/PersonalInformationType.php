<?php

namespace CvPlatform\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonalInformationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add(
                'birthdate',
                'date',
                array(
                    'years' => range(1940,2000),
                    'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                    'horizontal_input_wrapper_class' => 'col-lg-3',
                    'widget' => 'choice'
                )
            )
            ->add('email', 'email', array(

                'horizontal_input_wrapper_class' => 'col-lg-9'))

            ->add('cellphone', 'text')
            ->add('phone', 'text')
            ->add('street', 'text', array('widget_type'  => "inline"))
            ->add('city', 'text')
            ->add('zipcode', 'text')
            ->add('country', 'text')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CvPlatform\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'update_personnal_inforamtions';
    }
}
