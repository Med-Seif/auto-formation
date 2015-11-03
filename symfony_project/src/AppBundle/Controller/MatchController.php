<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\MatchType;
use \AppBundle\Entity\Match;

class MatchController extends Controller {
    /**
     * @Route("/match/index")
     */
    public function indexAction() {
        $m      = new Match();
        $em     = $this->getDoctrine()->getManager();
        $matchs = $em->getRepository("AppBundle:Match")->myFindAll();
        return $this->render('match/index.html.twig', array('matchs' => $matchs));
    }

    /**
     * @Route("/match/insert")
     */
    public function insertAction(Request $request) {
        $form = $this->createForm(new MatchType($this->getDoctrine()->getManager()));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $em   = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }
        return $this->render('match/insert.html.twig', array('form' => $form->createView()));
        /* $em = $this->getDoctrine()->getManager();
          $em->persist($match);
          $em->flush();

          return new Response('Created match id ' . $match->getId());
          return $this->render('match/insert.html.twig'); */
    }

    /**
     * @Route("/match/update/{id}")
     */
    public function updateAction($id) {
        $match = $this->getDoctrine()
                ->getRepository('AppBundle:Match')
                ->find($id);
        if (!$match) {
            throw $this->createNotFoundException('Aucun match trouvé pour cet id : ' . $id);
        }
        return $this->render('match/update.html.twig', array('item' => $match));
    }

    /**
     * @Route("/match/delete/{id}")
     */
    public function deleteAction($id) {
        return $this->render('match/delete.html.twig');
    }

}
