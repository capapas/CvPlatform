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
            ->add('birthdate', 'date')
            ->add('email', 'email')
            ->add('cellphone', 'text')
            ->add('phone', 'text')
            ->add('street', 'text')
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
        return 'cvplatform_userbundle_personalinformationstype';
    }
}
