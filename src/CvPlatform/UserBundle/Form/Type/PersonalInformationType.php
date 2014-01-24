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
            ->add('birthdate', 'date')
            ->add('firstname', 'text')
            ->add('lastname', 'text')
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
