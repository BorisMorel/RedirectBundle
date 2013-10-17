<?php

namespace BOMO\RedirectBundle\Form\Type;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface
    ;

use BOMO\RedirectBundle\Util\RedirectStatus;

class RedirectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('urlSource')
            ->add('urlTarget')
            ->add('code', 'choice', array(
                'choices' => RedirectStatus::getRedirectStatus(),
            ))
            ->add('isActive')
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BOMO\RedirectBundle\Entity\Redirect',
        ));
    }

    public function getName()
    {
        return 'redirect';
    }


}
