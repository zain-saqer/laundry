<?php

namespace App\Controller\Order;

use App\Laundry\Order\Model\TimeOfDay;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewOrderFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberOfLoads', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('pickupDate', DateType::class, [
                'input' => 'datetime_immutable',
            ])
            ->add('timeOfDay', ChoiceType::class, [
                'choices' => [
                    '09:00 to 12:00' => TimeOfDay::T_9_TO_12,
                    '12:00 to 15:00' => TimeOfDay::T_12_TO_15,
                    '15:00 to 18:00' => TimeOfDay::T_15_TO_18,
                    '18:00 to 21:00' => TimeOfDay::T_18_TO_21,
                ],
            ])
            ->add('comment', TextareaType::class, [
                'required' => false,
            ])
            ->add('create', SubmitType::class, [
                'label' => 'Create',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewOrderModel::class,
        ]);
        parent::configureOptions($resolver);
    }
}
