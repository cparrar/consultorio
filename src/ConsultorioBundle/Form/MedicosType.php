<?php

namespace ConsultorioBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MedicosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, [
            'label' => 'Nombre',
            'constraints' => [
                new NotBlank(['message' => 'Campo Requerido'])
            ]
        ])
            ->add('apellido', TextType::class, [
                'label' => 'Apellido',
                'constraints' => [
                    new NotBlank(['message' => 'Campo Requerido'])
                ]
            ])
            ->add('especialidad', EntityType::class, [
                'label' => 'Especialidad',
                'class' => 'ConsultorioBundle:Especialidades',
                'choice_label' => 'nombre',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nombre', 'ASC');
                },
                'constraints' => [
                    new NotBlank(['message' => 'Campo Requerido'])
                ]
            ])
            ->add('consultorio', EntityType::class, [
                'label' => 'Consultorio',
                'class' => 'ConsultorioBundle:Consultorios',
                'choice_label' => 'nombre',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nombre', 'ASC');
                },
                'constraints' => [
                    new NotBlank(['message' => 'Campo Requerido'])
                ]
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ConsultorioBundle\Entity\Medicos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'consultoriobundle_medicos';
    }
}