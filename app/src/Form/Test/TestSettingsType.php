<?php

namespace App\Form\Test;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('api_key', TextType::class)
            ->add('hook_url', UrlType::class)
            ->add('list', ChoiceType::class, [
                'choices' => $options['list_choices'] ?? [],
                'autocomplete' => true,
            ])
            ->add('pipeline', ChoiceType::class, [
                'choices' => $options['pipeline_choices'] ?? [],
                'autocomplete' => true,
            ])
            ->add('events', CollectionType::class, [
                'entry_type' => TestEventType::class,
                'entry_options' =>[
                    'type_choices' => $options['event_type_choices'] ?? [],
                    'stage_choices' => $options['event_stage_choices'] ?? [],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
            ])
            ->add('submit', SubmitType::class)
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
            'api_key' => '',
            'hook_url' => '',
            'list_choices' => [],
            'pipeline_choices' => [],

            'events' => [],
            'event_type_choices' => [],
            'event_stage_choices' => [],
        ]);

        $resolver->setAllowedTypes('api_key','string');
        $resolver->setAllowedTypes('hook_url', 'string');

        $resolver->setAllowedTypes('list_choices', 'array');
        $resolver->setAllowedTypes('pipeline_choices', 'array');

        $resolver->setAllowedTypes('events', 'array');
        $resolver->setAllowedTypes('event_type_choices', 'array');
        $resolver->setAllowedTypes('event_stage_choices', 'array');
    }
}
