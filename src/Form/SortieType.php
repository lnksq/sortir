<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie'])
            ->add('dateHeureDebut', DateType::class, [
                'label' => 'Date et heure de la sortie', 'html5' => true, 'widget' => 'single_text'])
            ->add('dateLimiteInscription', DateType::class, [
                'label' => "Date limite d'inscription", 'html5' => true, 'widget' => 'single_text'])
            ->add('nbInscriptionMax', NumberType::class, [
                'label' => 'Nombre de place'
            ])
            ->add('duree', NumberType::class, [
                    'label' => 'Durée'
                ]
            )
            ->add('infosSortie', TextareaType::class, [
                'label' => 'Description et infos'
            ])
            ->add('campus', EntityType::class, [
                'label' => 'Campus',
                'class' => Campus::class,
                'choice_label' => 'nom'
            ])
            ->add('ville', EntityType::class, [
                'label' => 'ville',
                'class' => Ville::class,
                'choice_label' => 'nom',
                'mapped'=>false

            ])
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'nom',
                'mapped' => false
            ])
            ->add('rue', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'rue',
                'mapped' => false
            ])
            ->add('latitude', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'latitude',
                'mapped' => false
            ])
            ->add('longitude', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'longitude',
                'mapped' => false
            ])
            ->add('enregister', SubmitType::class, [
                'label'=>'Enregistrer'
            ])
            ->add('publierSortie', SubmitType::class, [
                'label'=>'Publier la Sortie'
            ])
            ->add('Annuler', SubmitType::class, [
                'label'=>'Annuler'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}