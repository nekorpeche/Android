<?php

namespace CcMtBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@CcMt/Default/index.html.twig');
    }
        
    public function getVisiteurNomAction($matricule){
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CcMtBundle:Visiteur');
        $leVisiteur = $repository->findOneBy(array('visMatricule'=>$matricule));
        $response = new JsonResponse($leVisiteur);
        $response->headers->set('Content-Type','application/json');
        return $response;
    }
    
    // Retourne la liste des visiteurs sous forme d'un tableau d'objets Json
    // Côté client mobile : response sous forme de JSONArray 
    public function getLesVisiteursAction() { 
        
        $rp = $this->getDoctrine()->getManager()->getRepository('CcMtBundle:Visiteur');
        $lesVisiteurs = $rp->findAll();
        return new JsonResponse($lesVisiteurs);
       
        
    }
    
    // Retourne un visiteur sous forme d'un JSONObject
    // L'entité Visiteur implémente l'interface JsonSerializable
    public function getUnVisiteurAction($login, $mdp) {
        
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CcMtBundle:Visiteur');
        $leVisiteur = $repository->findOneBy(array('visLogin'=>$login, 'visMdp'=>$mdp));
        
        $response = new JsonResponse($leVisiteur);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    // Retourne une réponse sous forme de JSONArray 
    public function getLesPraticiensAction() {
        $em = $this->getDoctrine()->getManager();
        $rp = $em->getRepository('CcMtBundle:Praticien');
        $data = $rp->findAll(); //>getArrayResult();
        if (empty($data)) {
            return new JsonResponse(['message'=> 'Liste vide'], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse($data);
               
    }
    
    // Idem : tableau d'objets Json
    public function getLesPraticiensParVisiteurAction($matricule) {
        $em = $this->getDoctrine()->getManager();
        $rp = $em->getRepository('CcMtBundle:Praticien');
        // Exemple d'utilisation du DQL (plus facile pour récupérer les clés
        // étrangères
        $lesPraticiens = $rp->findByPraVisiteurDQL($matricule);
        
        return new JsonResponse($lesPraticiens);
    }

    // Exemple avec le service Serializer de Symfony
    public function getLesTypesPraticiensAction() {
        $rp = $this->getDoctrine()->getManager()
                ->getRepository('CcMtBundle:TypePraticien');
        
        $typesPraticiens = $rp->findAll();
        // Ici, un exemple d'utilisation du service serializer de Symfony
        // Du coup, pas besoin pas besoin d'implémenter JsonSerializable
        // dans l'entity TypePraticien
        $lesTypesPraticiens = $this->get('serializer')
                ->serialize($typesPraticiens, 'json');
        
        return new Response($lesTypesPraticiens); 
    }
    public function setRapportVisite($rapNum, $rapBilan,$rapDatevisite,$rapDaterapport,$praNum,$visMatricule){
        $r = new \CcMtBundle\Entity\RapportVisite();
       $r->setPraNum($praNum);
       $r->setRapBilan($rapBilan);
       $r->setRapDaterapport($rapDaterapport);
       $r->setRapDatevisite($rapDatevisite);
      $r->setRapNum($rapNum);
      $r->setVisMatricule($visMatricule);
     $em = $this->getDoctrine()->getManager();
     $rp = $em->getRepository('CcMtBundle:RapportVisite');
     $em->persist($r);
     $em->flush();
        
    }
    
    public function getLesRapports($visMatricule){
        $em = $this->getDoctrine()->getManager();
        $rp = $em->getRepository('CcMtBundle:RapportVisite');
        $lesRapports = $rp->findBy(array('visMatricule'=>$visMatricule));
        return new JsonResponse($lesRapports);
        
    }
}
