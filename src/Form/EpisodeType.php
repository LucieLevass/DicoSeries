<?php

namespace App\Form;

use App\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Saison;
use App\Entity\Serie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Repository\SaisonRepository;
use App\Repository\SerieRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numEpisode')
            ->add('titreVF')
            ->add('titreVO')
            ->add('resume')
            ->add('dateDiffVO', DateType::class, [
              'widget' => 'single_text',
            ])
            ->add('dateDiffVF', DateType::class, [
              'widget' => 'single_text',
            ])
            ->add('serie', EntityType::class, [
              'class'       => Serie::class,
              'placeholder' => 'Choisir une Serie',
              'query_builder' => function (SerieRepository $repo) {
                  return $repo->createQueryBuilder('s')
                              ->orderBy('s.titreVF', 'ASC');
              },
            ]);

            $formModifier = function(FormInterface $form, Serie $serie = null){
              $saisons = null === $serie ? [] : $serie->getSaisons();

              $form->add('saison', EntityType::class, [
                'class' => Saison::class,
                'placeholder' => $saisons ? 'Choisir une saison' : 'Choisir une série',
                'choices' => $saisons,
              ]);
            };

            $builder->addEventListener(
              FormEvents::PRE_SET_DATA,
              function(FormEvent $event) use ($formModifier){
                $data = $event->getData();
                $formModifier($event->getForm(), $data->getSerie());
              }
            );


            $builder->get('serie')->addEventListener(FormEvents::POST_SUBMIT,
              function (FormEvent $event) use ($formModifier) {
                $form = $event->getForm();
                $formModifier($form->getParent(), $form->getData());
              }
            );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
            //'csrf_protection' => false,
        ]);
    }
}
