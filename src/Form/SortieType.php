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
            ->add('nom', TextType::class)
            ->add('dateHeureDebut', DateType::class, ['html5' => true, 'widget' => 'single_text'])
            ->add('dateLimiteInscription', DateType::class, ['html5' => true, 'widget' => 'single_text'])
            ->add('nbInscriptionMax', NumberType::class)
            ->add('duree', NumberType::class)
            ->add('infosSortie', TextareaType::class)
            ->add('lieu', null,  ['choice_label' => 'nom'])
            ->add('campus', EntityType::class, ['class'=>Campus::class, 'choice_label'=> 'nom' ])


            ->add('enregistrer', SubmitType::class, ['label'=>'Enregistrer'])
            ->add('publierSortie', SubmitType::class, [ 'label'=>'Publier la Sortie' ])
            ->add('annuler', SubmitType::class, ['label'=>'Annuler' ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
            'allow_extra_fields'=>true
        ]);
    }
}