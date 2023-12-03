<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => $options['type_choices'] ?? [],
                'label' => false,
                'autocomplete' => true,
            ])
            ->add('stage', ChoiceType::class, [
                'choices' => $options['stage_choices'] ?? [],
                'label' => false,
                'autocomplete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'type_choices' => [],
            'stage_choices' => [],
        ]);

        $resolver->setAllowedTypes('type_choices', 'array');
        $resolver->setAllowedTypes('stage_choices', 'array');
    }
}
