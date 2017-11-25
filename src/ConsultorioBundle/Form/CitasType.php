<?php

namespace ConsultorioBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fechaAt', DateType::class, [
            'label' => 'Fecha de la Cita'
        ])
            ->add('precio')
            ->add('paciente', EntityType::class, [
                'label' => 'Paciente',
                'class' => 'ConsultorioBundle:Pacientes',
                'choice_label' => function ($entity) {
                    return sprintf('%s %s', $entity->getNombre(), $entity->getApellido());
                }
            ])
            ->add('medico', EntityType::class, [
                'label' => 'Medico',
                'class' => 'ConsultorioBundle:Medicos',
                'choice_label' => function ($medicos) {
                    return sprintf('[%s] %s %s', $medicos->getEspecialidad()->getNombre(), $medicos->getNombre(), $medicos->getApellido());
                }
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ConsultorioBundle\Entity\Citas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'consultoriobundle_citas';
    }


}
