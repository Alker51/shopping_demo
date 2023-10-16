<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('billingAdress')
            ->add('billingPostCode')
            ->add('billingTown')
            ->add('billingCountry')
            ->add('shippingAdress')
            ->add('shippingPostCode')
            ->add('shippingTown')
            ->add('shippingCountry')
            ->add('shippingPhoneNum')
            ->add('shippingFirstName')
            ->add('shippingLastName')
            ->add('orderState')
            ->add('orderDate')
            ->add('Total_WTax')
            ->add('Total_Tax')
            ->add('numOrder')
            ->add('Products')
            ->add('userCommand')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
