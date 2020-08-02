<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Entity\User;
use App\Form\SocieteType;
use App\Form\SocieteType2;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use  App\Repository\UsertestRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;

/**
 * @Route("/societe")
 */
class SocieteController extends AbstractController
{
    /**
     * @Route("/", name="societe_index", methods={"GET"})
     */
    public function index(): Response
    {
        $societes = $this->getDoctrine()
            ->getRepository(Societe::class)
            ->findAll();

        return $this->render('societe/index.html.twig', [
            'societes' => $societes,

        ]);
    }

    /**
     * @Route("/{id}/gerant", name="societe_gerant")
     */
    public function affichergerant($id ): Response
    {
        $em = $this->getDoctrine()->getManager();
        ;
        $societe =$em->getRepository(Societe::class)->find($id);

        return $this->render('societe/listeusers.html.twig', [
            'societe' => $societe,

        ]);
    }
    /**
     * @Route("/new", name="societe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response

    {
        $user = $this->getUser();
        $societe = new Societe();
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $societe->setCreator($user);
            $societe->uploadProfilePicture();
            // $societe->setCreation(date());
            $time = new \DateTime('now');
            echo $time->format('H:i:s \O\n Y-m-d');
            $societe->setCreation($time);
        };
        if ($form->isSubmitted()&& $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($societe);
            $entityManager->flush();

            return $this->redirectToRoute('societe_index');
        }

        return $this->render('societe/new.html.twig', [
            'societe' => $societe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="societe_show", methods={"GET"})
     */
    public function show(Societe $societe): Response
    {
        return $this->render('societe/show.html.twig', [
            'societe' => $societe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="societe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Societe $societe): Response
    {
        $form = $this->createForm(SocieteType::class, $societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('societe_index');
        }

        return $this->render('societe/edit.html.twig', [
            'societe' => $societe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="societe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Societe $societe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$societe->getIdsociete(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($societe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('societe_index');
    }

    /**
     * @Route("/{id}/{userid}/affecter", name="societe_affecter")
     */
    public function affecterAction( Request $request,$id,$userid, \Swift_Mailer $mailer) {

        $em = $this->getDoctrine()->getManager();
        ;
        $societe =$em->getRepository(Societe::class)->find($id);
        $form = $this->createForm(SocieteType2::class, $societe);
        $form->handleRequest($request);
        // $userid = $this->getUser()->getId();
        $user = $em->getRepository(User::class)->find($userid);

     /*   if($societe ->getUsers()->contains($user)){
            $msg = "admin est déja affecté";
            return $this->render('societe/no.html.twig', array('msg'=>$msg));

        }

        else {
            $users = $societe->getUsers();

            $users->add($user);
            $societe->setUsers($users);*/

       $societe->addUser($user);
        $email = $user->getEmail();
        $id = $user->getId();
        $message = (new \Swift_Message())
            ->setSubject($societe->getNomsoc())
            ->setFrom('gestion.pointage2020@gmail.com:')
            ->setTo($email)
            ->setBody(
                $this->renderView(

                    'societe/mail.html.twig',
                    ['societe' => $societe]
                ));



                $mailer->send($message);


            $em->flush();
            $msg = "il est affecté avec succés!! ";
            return $this->render('societe/succes.html.twig', array('msg'=>$msg));

        }



    /**
     * @Route("/{id}/edit2", name="societe_edit2")
     */

    public function edit2(Request $request ,Societe $societe)
    {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(SocieteType2::class, $societe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userid = $form->get('Users')->getData()->getId();
            echo gettype($userid);
           // $user = $em->getRepository(User::class)->find(11);
            //$societe->addUser($user);
            //$em->flush();
       /* if($societe ->getUsers()->contains($user)){
                $msg = "admin est déja affecté";
                return $this->render('societe/no.html.twig', array('msg'=>$msg));

            }

            else {
                $users = $societe->getUsers();

                $users->add($user);
                $societe->setUsers($users);



                $em->flush();
                $msg = "il est affecté avec succés!! ";
                return $this->render('societe/succes.html.twig', array('msg'=>$msg));

            }
            //$msg = "il est affecté avec succés!! ";
            //return $this->render('societe/succes.html.twig', array('msg'=>$msg));*/


           return $this->redirectToRoute('societe_affecter', array('id' => $societe->getId(),'userid'=> $userid ));

        //return $this->render('societe/succes.html.twig' , ['user' => $userid ,'user2'=>$user ]);
        }

        return $this->render('societe/edit.html.twig', [
            'societe' => $societe,
            'form' => $form->createView(),
        ]);

}

}