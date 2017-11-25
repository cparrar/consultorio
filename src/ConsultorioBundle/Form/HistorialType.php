<?php

namespace ConsultorioBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistorialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('descripcion')
            ->add('motivo')
            ->add('cita', EntityType::class, [
                'label' => 'Cita Medica',
                'class' => 'ConsultorioBundle:Citas',
                'choice_label' => function ($entity) {
                    return sprintf('[%03s] %s %s', $entity->getId(), $entity->getPaciente()->getNombre(), $entity->getPaciente()->getApellido());
                }
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ConsultorioBundle\Entity\Historial'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'consultoriobundle_historial';
    }


}
