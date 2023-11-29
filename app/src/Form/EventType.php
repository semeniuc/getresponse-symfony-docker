<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => $options['type_choices'] ?? [],
                'required' => true,
            ])
            ->add('stage', ChoiceType::class, [
                'choices' => $options['stage_choices'] ?? [],
                'required' => true,
            ])
            ;

        // Logging
        dump([
            'options' => $options,
            'getOptions' => $builder->getOptions(),
            'getFormConfig' => $builder->getFormConfig(),
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'type_choices' => [],
            'stage_choices' => [],
        ]);
    }
}
