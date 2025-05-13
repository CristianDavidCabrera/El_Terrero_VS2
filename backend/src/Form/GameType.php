<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matchDay', null, [
                'label' => 'Match day', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
            ->add('isWinner',null, [
                'label' => 'Is winner', 
                'label_attr' => [
                    'class' => 'text-white font-semibold mb-2'
                ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
            ->add('onPlay', null, [
                'label' => 'On play', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
            ->add('visitorTeam', null, [
                'label' => 'Visitor Team', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
            ->add('localTeam', null, [
                'label' => 'Local Team', 
                    'label_attr' => [
                        'class' => 'text-white font-semibold mb-2'
                    ],
                'attr' => [
                    'class' => 'my-4 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
