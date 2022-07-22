<?php

namespace App\Form;

use App\Entity\Campus;
use App\Form\model\FiltresSorties;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('campus', EntityType::class, [
                'label' => 'Campus',
                'class'=>Campus::class,
                'choice_label'=>'nom',
                'required'=>false

            ])
            ->add('motRecherche', SearchType::class, [
                'label' => 'La nom de la sortie contient :'
    ])
            ->add('premiereDate', DateType::class, [
            'label'=> 'Entre',  'html5'=> true, 'widget' => 'single_text'])
            ->add('derniereDate', DateType::class, [
                'label'=> 'et',  'html5'=> true, 'widget' => 'single_text'])
            ->add('organisateur', CheckboxType::class, [
                'label' => "Sorties dont je suis l'organisateur/trice", 'required'=>false
            ])
            ->add('inscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e' , 'required'=>false])
            ->add('pasInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e' , 'required'=>false])
            ->add('SortiesPasses', CheckboxType::class, [
                'label'=> 'Sorties passées', 'mapped'=> false,
                'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FiltresSorties::class,
        ]);
    }
}
