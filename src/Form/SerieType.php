<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Status;
use App\Entity\Pays;
use App\Entity\Genre;
use App\Repository\GenreRepository;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreVF')
            ->add('titreVO')
            ->add('anneeDeb')
            ->add('anneeFin')
            ->add('description')
            ->add('status', EntityType::class, [
              'class' => Status::class,
              'placeholder' => 'Choisir un status',
            ])
            ->add('pays', EntityType::class, [
              'class' => Pays::class,
              'placeholder' => 'Choisir le pays d\'origine',
            ])
            ->add('genres', EntityType::class, [
              'class' => Genre::class,
              'multiple' => true,
              'expanded' => true,
              'query_builder' => function (GenreRepository $repo) {
                  return $repo->createQueryBuilder('g')
                              ->orderBy('g.nomGenre', 'ASC');
              },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
