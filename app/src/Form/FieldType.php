<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entity', ChoiceType::class, [
               'choices' => $options['entity'],
               'required' => true,
            ])
            ->add('field_bitrix24', ChoiceType::class, [
                'choices' => $options['field_bitrix24'],
                'required' => true,
            ])
            ->add('field_getresponse', ChoiceType::class, [
                'choices' => $options['field_getresponse'],
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entity' => [
                'entity_1' => 'entity_1',
                'entity_2' => 'entity_2',
                'entity_3' => 'entity_3',
            ],
            'field_bitrix24' => [
                'field_1' => 'field_1',
                'field_2' => 'field_2',
                'field_3' => 'field_3',
            ],
            'field_getresponse' => [
                'field_1' => 'field_1',
                'field_2' => 'field_2',
                'field_3' => 'field_3',
            ],
        ]);

        $resolver->setAllowedTypes('entity', 'array');
        $resolver->setAllowedTypes('field_bitrix24', 'array');
        $resolver->setAllowedTypes('field_getresponse', 'array');
    }
}
