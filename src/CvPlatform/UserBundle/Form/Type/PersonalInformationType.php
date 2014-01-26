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
                    'horizontal_input_wrapper_class' => 'col-lg-2',
                    'widget' => 'choice',
                )
            )
            ->add('email', 'email')
            ->add('cellphone', 'text')
            ->add('phone', 'text')
            ->add('street', 'text', array('widget_type'  => "inline"))
            ->add('city', 'text')
            ->add('zipcode', 'text')
            ->add('country', 'country')
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
