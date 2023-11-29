<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('api_key', TextType::class, [
                'data' => $options['api_key'] ?? '',
                'required' => true,
            ])
            ->add('hook_url', TextType::class, [
                'data' => $options['hook_url'] ?? '',
                'required' => false,
            ])
            ->add('list', ChoiceType::class, [
                'choices' => $options['list'] ?? [],
                'required' => false,
            ])
            ->add('pipeline', ChoiceType::class, [
                'choices' => $options['pipeline'] ?? [],
                'required' => false,
            ])
            ->add('fields', CollectionType::class, [
                'entry_type' => FieldType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => false,
                'required' => false,
            ])
            ->add('events', CollectionType::class, [
                'entry_type' => EventType::class,
                'entry_options' => [
                    'event_choices' => $options['event_choices'] ?? [],
                    'stage_choices' => $options['stage_choices'] ?? [],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'mapped' => false,
                'required' => false,
            ])
            // ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            //     $form = $event->getForm();
            //     $data = $event->getData();

            //     // Transmit current data to EventType
            //     $form->add('events', CollectionType::class, [
            //         'entry_type' => EventType::class,
            //         'allow_add' => true,
            //         'allow_delete' => true,
            //         'by_reference' => false,
            //         'mapped' => false,
            //         'required' => false,
            //         'entry_options' => [
            //             'event_choices' => $data['event_choices'] ?? [],
            //             'stage_choices' => $data['stage_choices'] ?? [],
            //         ],
            //     ]);
            // })
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
            'data_class' => null,
            'allow_extra_fields' => true,

            'api_key' => '',
            'hook_url' => '',
            'list' => [],
            'pipeline' => [],

            'fields' => [],
            'events' => [],
            'event_choices' => [],
            'stage_choices' => [],
        ]);

        $resolver->setAllowedTypes('api_key','string');
        $resolver->setAllowedTypes('hook_url', 'string');

        $resolver->setAllowedTypes('list', 'array');
        $resolver->setAllowedTypes('pipeline', 'array');
        $resolver->setAllowedTypes('fields', 'array');
        $resolver->setAllowedTypes('events', 'array');
    }
}
