<?php

namespace App\Form;

use App\Entity\Club;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('division', null, [
                'label' => 'Division', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
          /*   ->add('id_fighter', null, [
                'label' => 'Fighter', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ]) */
            ->add('name', null, [
                'label' => 'Club Name', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
            ->add('id_club', EntityType::class, [
                'class' => Club::class,
                'choices' => [$options['user_club']],
                'choice_label' => 'name',
                'placeholder' => 'Select your club',
                'label' => 'Club Name', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
            'user_club' => null,
        ]);
    }
}
