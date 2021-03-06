<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($options['action'])
            ->add('name',TextType::class,array(
                'required' => true,
                'empty_data' => 'Event name',
                'attr'=>array('placeholder'=>'Event Name'))
            )
            ->add('dateBegin', DateTimeType::class,array(
                'data'=>new \DateTime("NOW"),
                'label'=>'Begin date'
            ))
            ->add('dateEnd', DateTimeType::class,array('data'=>new \DateTime("NOW")))
            ->add('location')->add('image',FileType::class,
                array('data_class' => null,
                    'required' => false,
                    'attr'=>array('placeholder'=>'Location')
                ))
            ->add('description', TextType::class, array(
                'attr'=>array('placeholder'=>'Description')
            ))
            ->add('price',IntegerType::class, array(
                'attr'=>array('placeholder'=>'Price')
            ))
            ->add('submit',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_event';
    }
}
