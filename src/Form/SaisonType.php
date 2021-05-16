<?php

namespace App\Form;

use App\Entity\Saison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Serie;

class SaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numSaison')
            ->add('description')
            ->add('anneeDeb')
            ->add('anneeFin')
            ->add('serie', EntityType::class, [
              'class' => Serie::class,
              'placeholder' => 'Choisir une série',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Saison::class,
        ]);
    }
}
