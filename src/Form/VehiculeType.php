<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', TextType::class)
            ->add('modele', TextType::class)
            ->add('dateImmatriculation', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('numeroImmatriculation', TextType::class)
            ->add('caracteristiques', ChoiceType::class, [
                'choices' => [
                    'Nombre de portes' => 'nombre_de_portes',
                    'Énergie' => 'energie',
                    'Boîte de vitesses' => 'boite_de_vitesses',
                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('proprietaire', null, [
                'choice_label' => function($proprietaire) {
                    return $proprietaire->getNom() . ' ' . $proprietaire->getPrenom();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
