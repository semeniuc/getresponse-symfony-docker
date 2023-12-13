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
                'choices' => $options['entity_choices'],
                'label' => false,
                'autocomplete' => true,
            ])
            ->add('bitrix', ChoiceType::class, [
                'choices' => $options['bitrix_choices'],
                'label' => false,
                'autocomplete' => true,
            ])
            ->add('getresponse', ChoiceType::class, [
                'choices' => $options['getresponse_choices'],
                'label' => false,
                'autocomplete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'entity_choices'        => [],
            'bitrix_choices'        => [],
            'getresponse_choices'   => [],
        ]);

        $resolver->setAllowedTypes('entity_choices', 'array');
        $resolver->setAllowedTypes('bitrix_choices', 'array');
        $resolver->setAllowedTypes('getresponse_choices', 'array');
    }
}
