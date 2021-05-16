<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Form\SerieType;
use App\Form\SaisonType;
use App\Form\EpisodeType;
use App\Entity\Serie;
use App\Entity\Saison;
use App\Entity\Episode;
use App\Entity\Status;
use App\Entity\Pays;
use App\Entity\Genre;
use App\Repository\SerieRepository;
use App\Repository\SaisonRepository;
use App\Repository\EpisodeRepository;
use App\Repository\StatusRepository;
use App\Repository\PaysRepository;
use App\Repository\GenreRepository;
use Knp\Component\Pager\PaginatorInterface;

class SeriesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('series/index.html.twig', [
            'controller_name' => 'SeriesController',
        ]);
    }

    /**
    * @Route("/new_serie", name="NewSerie")
    */
    public function createSerie(Request $request){
      $serie = new Serie();
      $manager = $this->getDoctrine()->getManager();

      $form = $this->createForm(SerieType::class, $serie);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($serie);
        $manager->flush();

        return $this->redirectToRoute('NewSerie');
      }

      return $this->render('series/create_serie.html.twig', [
          'formSerie' => $form->createView(),
      ]);
    }

    /**
    * @Route("/new_saison", name="NewSaison")
    */
    public function createSaison(Request $request){
      $saison = new Saison();
      $manager = $this->getDoctrine()->getManager();

      $form = $this->createForm(SaisonType::class, $saison);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($saison);
        $manager->flush();

        return $this->redirectToRoute('NewSaison');
      }

      return $this->render('series/create_saison.html.twig', [
          'formSaison' => $form->createView(),
      ]);
    }

    /**
    * @Route("/New_episode", name="NewEpisode")
    */
    public function createEpisode(Request $request){
      $episode = new Episode();
      $manager = $this->getDoctrine()->getManager();

      $form = $this->createForm(EpisodeType::class, $episode);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($episode);
        $manager->flush();

        return $this->redirectToRoute('NewEpisode');
      }

      return $this->render('series/create_episode.html.twig', [
          'formEpisode' => $form->createView(),
      ]);
    }

    /**
    * @Route("/series", name="series_liste")
    */
    public function getSeries(Request $request, PaginatorInterface $paginator, SerieRepository $repo){
      $donnees = $repo->findAllOrder();
      //$series = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);

      return $this->render('series/series.html.twig', [
          'series' => /**$series*/ $donnees,
      ]);
    }

    /**
    * @Route("/series/status", name="status_liste")
    */
    public function getStatus(StatusRepository $repoStatus){
      $status = $repoStatus->findAllOrder();

      return $this->render('series/status.html.twig', [
          'status' => $status,
      ]);
    }

    /**
    * @Route("/series/status/{nomStatus}", name="series_status")
    */
    public function getSeriesByStatus(Status $status, Request $request, PaginatorInterface $paginator, SerieRepository $repo){
      $donnees = $repo->findByStatusId($status->getId());
      $series = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);

      return $this->render('series/series_status.html.twig', [
          'series' => $series,
          'status' => $status,
      ]);
    }

    /**
    * @Route("/series/pays", name="pays_liste")
    */
    public function getPays(PaysRepository $repo){
      $pays = $repo->findAllOrder();

      return $this->render('series/pays.html.twig', [
          'pays' => $pays,
      ]);
    }

    /**
    * @Route("/series/pays/{nomPays}", name="series_pays")
    */
    public function getSeriesByPays(Pays $pays, Request $request, PaginatorInterface $paginator, SerieRepository $repo){
      $donnees = $repo->findByPaysId($pays->getId());
      $series = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);

      return $this->render('series/series_pays.html.twig', [
          'series' => $series,
          'pays' => $pays,
      ]);
    }

    /**
    * @Route("/series/genres", name="genres_liste")
    */
    public function getGenres(GenreRepository $repo){
      $genres = $repo->findAllOrder();

      return $this->render('series/genres.html.twig', [
          'genres' => $genres,
      ]);
    }

    /**
    * @Route("/series/genres/{nomGenre}", name="series_genre")
    */
    public function getSeriesByGenre(Genre $genre, Request $request, PaginatorInterface $paginator, SerieRepository $repo){
      $donnees = $repo->findByGenreId($genre->getId());
      $series = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);

      return $this->render('series/series_genre.html.twig', [
          'series' => $series,
          'genre' => $genre,
      ]);
    }

    /**
    * @Route("/series/{slugSerie}", name="serie_show")
    */
    public function showSerie(Serie $serie, SaisonRepository $repoSaison){
      $saisons = $repoSaison->findBySerieId($serie->getId());

      return $this->render('series/show_serie.html.twig', [
        'saisons' => $saisons,
        'serie' => $serie,
      ]);
    }

    /**
    * @Route("/series/{slugSerie}/{slugSaison}", name="saison_show")
    */
    public function showSaison(Saison $saison, EpisodeRepository $repo){
      $episodes = $repo->findBySaisonId($saison->getId());

      return $this->render('series/show_saison.html.twig', [
        'saison' => $saison,
        'episodes' => $episodes,
      ]);
    }

    /**
    * @Route("/series/{slugSerie}/{slugSaison}/{slugEpisode}", name="episode_show")
    */
    public function showEpisode(Episode $episode){

      return $this->render('series/show_episode.html.twig', [
        'episode' => $episode,
      ]);
    }

}
