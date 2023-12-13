<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Field;

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
            'data_class' => Field::class,
        ]);
    }
}
