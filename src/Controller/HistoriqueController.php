<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Entity\Historique;
use App\Form\HistoriqueType;
use App\Repository\HistoriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime ;

/**
 * @Route("/historique")
 */
class HistoriqueController extends AbstractController
{
    /**
     * @Route("/", name="historique_index", methods={"GET"})
     */
    public function index(HistoriqueRepository $historiqueRepository): Response
    {
        return $this->render('historique/index.html.twig', [
            'historiques' => $historiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="historique_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        ;
        $historique = new Historique();
        $form = $this->createForm(HistoriqueType::class, $historique);
        $form->handleRequest($request);
        $user = $this->getUser()->getId();
        $employe= $em->getRepository(Employe::class)->findByuser($user);
        $time = new \DateTime();


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $historique->setEmploye($employe);
            $historique->setDate($time);
            $historique->setheure_arrive($time->format('H:i:s '));
            $entityManager->persist($historique);
            $entityManager->flush();

            return $this->redirectToRoute('historique_index');
        }

        return $this->render('historique/new.html.twig', [
            'historique' => $historique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="historique_show", methods={"GET"})
     */
    public function show(Historique $historique): Response
    {
        return $this->render('historique/show.html.twig', [
            'historique' => $historique,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="historique_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Historique $historique): Response
    {
        $form = $this->createForm(HistoriqueType::class, $historique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('historique_index');
        }

        return $this->render('historique/edit.html.twig', [
            'historique' => $historique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="historique_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Historique $historique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($historique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('historique_index');
    }

    /**
     * @Route("/pointe/{id1}/{id2}", name="historique_pointer")
     */
    public function pointer()
    {
        $em = $this->getDoctrine()->getManager();
        ;
       $time = new \DateTime();
        $id1=$time->format('Y-m-d');
        $time1 = new \DateTime();
        $user = $this->getUser()->getId();
        $id2= $em->getRepository(Employe::class)->findByuser($user);
        $historique= $em->getRepository(Historique::class)->findBydate($id1,$id2)->setheure_depart($time1->format('H:i:s'));
        $em->flush();

        $arrive=$historique->getheure_arrive();
        $date = new \DateTime($arrive);

      $o = $date->format('H:i:s');
        /*$format = 'H:i:s';
        $date = DateTime::createFromFormat($format, $arrive);*/
        $depart=$historique->getheure_depart();
        $date2 = new \DateTime( $depart);
        $oo=$date2->format('Y-m-d');
        $diff = date_diff($date2,$date);

        $interval =  $diff->format("%h");
        $historique->setEcart($interval);
        $em->flush();

        return $this->render('historique/show1.html.twig', [
            'historique' => $historique,
        ]);
    }
}
