<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etape;
use AppBundle\Entity\Produit;
use AppBundle\Entity\PointVente;
use AppBundle\Entity\Synchro;
use AppBundle\Entity\Visite;
use AppBundle\Entity\Situation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use AppBundle\Entity\Secteur;
use AppBundle\Entity\Quartier;
/**
 * Etape controller.
 *
 */
class AppController extends Controller
{
    /**
     * Lists all etape entities.
     *
     */
    public function indexAction()
    {
        
        return $this->render('layout.html.twig');
    }


  
    /**
     * Finds and displays a etape entity.
     *
     */
    public function setPeriodeAction(Request $request)
    {
  
        $region=$request->request->get('region');
        $periode= $request->request->get('periode');
        $dates = explode(" - ", $periode);
        $startDate=$dates[0];
        $endDate=$dates[1];
        $format = 'd/m/Y';
        $startDate= \DateTime::createFromFormat($format, $dates[0]);
        $endDate= \DateTime::createFromFormat($format, $dates[1]);
        $session = $this->getRequest()->getSession();
        $session->set('region',$region);
        $session->set('startDate',$startDate->format('Y-m-d'));
        $session->set('endDate',$endDate->format('Y-m-d'));
        $session->set('periode',$periode);
        $session->set('end_date_formated',$endDate->format('d/m/Y'));
        $session->set('start_date_formated',$startDate->format('d/m/Y'));
       $referer = $this->getRequest()->headers->get('referer');   
         return new RedirectResponse($referer);
    }



}
