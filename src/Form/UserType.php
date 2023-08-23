<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $options = ['required' => false];

        $builder
            ->add('username', TextType::class)
            ->add('password', TextType::class)
            ->add('email', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('AdresseLine1', TextType::class, $options)
            ->add('AdresseLine2', TextType::class, $options)
            ->add('postalCode', NumberType::class, $options)
            ->add('city', TextType::class, $options)
            ->add('phoneNumber', NumberType::class, $options)
            ->add('avatarUrl', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
