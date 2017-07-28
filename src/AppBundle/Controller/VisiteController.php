<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Visite;
use AppBundle\Entity\Situation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

/**
 * Visite controller.
 *
 */
class VisiteController extends Controller
{
    /**
     * Lists all visite entities.
     *
     */
    public function dernieresVisitesAction($template='all')
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31') ;
        $dernieresVisites = $em->getRepository('AppBundle:Visite')->dernieresVisites($region,$startDate, $endDate);
       if($template=='all')
        return $this->render('visite/dernieres.html.twig', array(
            'visitesParPDV' => $dernieresVisites));
        return $this->render('visite/details/derniere/'.$template.'.html.twig', array(
        'visitesParPDV' => $dernieresVisites));

    }

    public function visitesPeriodeAction($template='all')
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31') ;
        $dernieresVisites = $em->getRepository('AppBundle:Visite')->visitesPeriode($region,$startDate, $endDate);
       if($template=='all')
        return $this->render('visite/dernieres.html.twig', array(
            'visitesParPDV' => $dernieresVisites));
        return $this->render('visite/details/periode/'.$template.'.html.twig', array(
        'visitesParPDV' => $dernieresVisites));

    }


    /**
     * Lists all visite entities.
     *
     */
    public function visitesAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $region=$session->get('region');
        $startDate=$session->get('startDate',date('Y').'-01-01');
        $endDate=$session->get('endDate', date('Y').'-12-31');
        $visites = $em->getRepository('AppBundle:Visite')->visites(null,$region,$startDate, $endDate,null);
        return $this->render('visite/visites.html.twig', array('visites' => $visites ));
    }
    /**
     * Finds and displays a visite entity.
     *
     */
    public function showAction(Visite $visite)
    {
 $colors=array("#FF6384","#36A2EB","#FFCE56","#F7464A","#FF5A5E","#46BFBD", "#5AD3D1","#FDB45C","#FFC870", "#5AE4D1","#FDB478","#FFD973");
        return $this->render('visite/show.html.twig', array(
            'visite' => $visite,'colors'=>$colors,
        ));
    }

public function boleanToString($boolVal,$id=true,$pasClient=false,$pasOuvert=false){
    if ($boolVal&&$id && !$pasClient && !$pasOuvert) 
     return 'OUI';
     elseif ($id && !$pasClient && !$pasOuvert) 
       return 'NON';
      else
       return '';
}

public function numberToString($intVal,$id=true){
    if ($intVal&&$id) 
     return $intVal;
     elseif ($id) 
       return $intVal;
      else
       return '';
   
}

       public function visitesExcelAction($name=null)
    {
      $em = $this->getDoctrine()->getManager();
      $session = $this->getRequest()->getSession();
      $region=$session->get('region');
      $startDate=$session->get('startDate',date('Y').'-01-01');
      $endDate=$session->get('endDate', date('Y').'-12-31');
      $periode= $session->get('periode',' 01/01 - 31/12/'.date('Y'));
      $visites = $em->getRepository('AppBundle:Visite')->visitesDetaillees($region,$startDate, $endDate);
      
        // ask the service for a Excel5
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AllReport")
           ->setLastModifiedBy("AllReport")
           ->setTitle("Historique des visites ".$region." de ".$periode)
           ->setSubject("Historique des visites ".$region." de ".$periode)
           ->setDescription("Historique des visites ".$region." de ".$periode)
           ->setKeywords("Historique des visites".$region." de ".$periode)
           ->setCategory("Rapports AllReport");
               $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'PDV')
               ->setCellValue('B1', 'MATRICULE')
               ->setCellValue('C1', 'TEL')
               ->setCellValue('D1', 'QUARTIER')
               ->setCellValue('E1', 'ADRESSE')
               ->setCellValue('F1', 'Auditeur')
               ->setCellValue('G1', 'date')
               ->setCellValue('H1', 'FKS')
               ->setCellValue('I1', 'FKL')
               ->setCellValue('J1', 'FMT')
               ->setCellValue('K1', 'FKM')
               ->setCellValue('L1', 'DUNHIL')
               ->setCellValue('M1', 'L-M')
               ->setCellValue('N1', 'MALBORO')
               ->setCellValue('O1', 'SUPER MATCH')
               ->setCellValue('P1', 'EXC')
               ->setCellValue('Q1', 'MAP')
               ->setCellValue('R1', 'PRE')
               ->setCellValue('S1', 'RPD')
               ->setCellValue('T1', 'RPP')
               ->setCellValue('U1', 'AP AC')
               ->setCellValue('V1', 'EST-IL OUVERT')
               ->setCellValue('W1', 'RAISON FERMETURE')
               ->setCellValue('X1', 'EST-IL CLIENT')
               ->setCellValue('Y1', 'RAISON NON CLIENT')
               ->setCellValue('Z1', 'COMMENTAIRE')
               ;
             foreach ($visites as $key => $value) {
                $date=new \DateTime($value['date']);
               $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A'.($key+2), $value['nom'])
               ->setCellValue('B'.($key+2), $value['matricule'])
               ->setCellValue('C'.($key+2), $value['telgerant'])
               ->setCellValue('D'.($key+2), $value['quartier'])
               ->setCellValue('E'.($key+2), $value['description'])                 
               ->setCellValue('F'.($key+2), $value['auditeur'])             
               ->setCellValue('G'.($key+2), $date->format('d/m/Y'))
               ->setCellValue('H'.($key+2), $value['fks'])
               ->setCellValue('I'.($key+2), $value['fkl'])
               ->setCellValue('J'.($key+2), $value['fmt'])
               ->setCellValue('K'.($key+2), $value['fkm']) 
               ->setCellValue('L'.($key+2), $value['dunhil'])
               ->setCellValue('M'.($key+2), $value['l_m'])
               ->setCellValue('N'.($key+2), $value['malboro'])
               ->setCellValue('O'.($key+2), $value['super_match'])                
               ->setCellValue('P'.($key+2), $this->boleanToString($value['exc'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('Q'.($key+2), $this->boleanToString($value['map'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('R'.($key+2), $this->boleanToString($value['pre'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('S'.($key+2), $this->boleanToString($value['rpd'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('T'.($key+2), $this->boleanToString($value['rpp'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('U'.($key+2), $this->boleanToString($value['sapp'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('V'.($key+2), $this->boleanToString(!$value['pas_ouvert']))
               ->setCellValue('W'.($key+2), $value['raison_pas_ouvert']) 
               ->setCellValue('X'.($key+2), $this->boleanToString(!$value['pas_client']))
               ->setCellValue('Y'.($key+2), $value['raison_pas_client'])
               ->setCellValue('Z'.($key+2), $value['commentaire'])   ;
           };
        $startDate=new \DateTime($startDate);
        $endDate= new \DateTime($endDate);
       $phpExcelObject->getActiveSheet()->setTitle('Du '.$startDate->format('d M Y').' au '.$endDate->format('d M Y'));
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers

        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'visites '.$region.' du '.$startDate->format('d M Y').' au '.$endDate->format('d M Y').'.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;        
    } 

  public function derniereVisiteExcelAction($name=null)
    {
      $em = $this->getDoctrine()->getManager();
      $session = $this->getRequest()->getSession();
      $region=$session->get('region');
      $startDate=$session->get('startDate',date('Y').'-01-01');
      $endDate=$session->get('endDate', date('Y').'-12-31');
      $periode= $session->get('periode',' 01/01 - 31/12/'.date('Y'));
      $visites = $em->getRepository('AppBundle:Visite')->dernieresVisites($region,$startDate, $endDate);
      
        // ask the service for a Excel5
       $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

       $phpExcelObject->getProperties()->setCreator("AllReport")
           ->setLastModifiedBy("AllReport")
           ->setTitle("Dernières visites ".$region." de ".$periode)
           ->setSubject("Dernières visites ".$region." de ".$periode)
           ->setDescription("Dernières visites ".$region." de ".$periode)
           ->setKeywords("Dernières visites".$region." de ".$periode)
           ->setCategory("Rapports AllReport");
  $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A1', 'PDV')
               ->setCellValue('B1', 'MATRICULE')
               ->setCellValue('C1', 'TEL')
               ->setCellValue('D1', 'QUARTIER')
               ->setCellValue('E1', 'ADRESSE')
               ->setCellValue('F1', 'Auditeur')
               ->setCellValue('G1', 'date')
               ->setCellValue('H1', 'FKS')
               ->setCellValue('I1', 'FKL')
               ->setCellValue('J1', 'FMT')
               ->setCellValue('K1', 'FKM')
               ->setCellValue('L1', 'DUNHIL')
               ->setCellValue('M1', 'L-M')
               ->setCellValue('N1', 'MALBORO')
               ->setCellValue('O1', 'SUPER MATCH')
               ->setCellValue('P1', 'EXC')
               ->setCellValue('Q1', 'MAP')
               ->setCellValue('R1', 'PRE')
               ->setCellValue('S1', 'RPD')
               ->setCellValue('T1', 'RPP')
               ->setCellValue('U1', 'AP AC')
               ->setCellValue('V1', 'EST-IL OUVERT')
               ->setCellValue('W1', 'RAISON FERMETURE')
               ->setCellValue('X1', 'EST-IL CLIENT')
               ->setCellValue('Y1', 'RAISON NON CLIENT')
               ->setCellValue('Z1', 'COMMENTAIRE')
               ;
             foreach ($visites as $key => $value) {
                $date=new \DateTime($value['date']);
               $phpExcelObject->setActiveSheetIndex(0)
               ->setCellValue('A'.($key+2), $value['nom'])
               ->setCellValue('B'.($key+2), $value['matricule'])
               ->setCellValue('C'.($key+2), $value['telgerant'])
               ->setCellValue('D'.($key+2), $value['quartier'])
               ->setCellValue('E'.($key+2), $value['description'])                 
               ->setCellValue('F'.($key+2), $value['auditeur'])             
               ->setCellValue('G'.($key+2), $date->format('d/m/Y'))
               ->setCellValue('H'.($key+2), $value['fks'])
               ->setCellValue('I'.($key+2), $value['fkl'])
               ->setCellValue('J'.($key+2), $value['fmt'])
               ->setCellValue('K'.($key+2), $value['fkm']) 
               ->setCellValue('L'.($key+2), $value['dunhil'])
               ->setCellValue('M'.($key+2), $value['l_m'])
               ->setCellValue('N'.($key+2), $value['malboro'])
               ->setCellValue('O'.($key+2), $value['super_match'])                
               ->setCellValue('P'.($key+2), $this->boleanToString($value['exc'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('Q'.($key+2), $this->boleanToString($value['map'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('R'.($key+2), $this->boleanToString($value['pre'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('S'.($key+2), $this->boleanToString($value['rpd'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('T'.($key+2), $this->boleanToString($value['rpp'],$value['id'],$value['pas_client'],$value['pas_ouvert']))
               ->setCellValue('U'.($key+2), $this->boleanToString($value['sapp'],$value['id'],$value['pas_client'],$value['pas_ouvert'])) 
               ->setCellValue('V'.($key+2), $this->boleanToString(!$value['pas_ouvert']))
               ->setCellValue('W'.($key+2), $value['raison_pas_ouvert']) 
               ->setCellValue('X'.($key+2), $this->boleanToString(!$value['pas_client']))
               ->setCellValue('Y'.($key+2), $value['raison_pas_client'])
               ->setCellValue('Z'.($key+2), $value['commentaire'])   ;
           };
        $startDate=new \DateTime($startDate);
        $endDate= new \DateTime($endDate);
       $phpExcelObject->getActiveSheet()->setTitle('Du '.$startDate->format('d M Y').' au '.$endDate->format('d M Y'));
       // Set active sheet index to the first sheet, so Excel opens this as the first sheet
       $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers

        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'dernieres visites '.$region.' du '.$startDate->format('d M Y').' au '.$endDate->format('d M Y').'.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;        
    }


     public function loadVisitesFromExcelAction()
    {
        $em = $this->getDoctrine()->getManager();
    $path = $this->get('kernel')->getRootDir(). "/../web/import/visites_traitees.xlsx";
     $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($path);
           $fks=$em->getRepository('AppBundle:Produit')->findOneByNom('FKS');
           $fkm=$em->getRepository('AppBundle:Produit')->findOneByNom('FKM');
           $fkl=$em->getRepository('AppBundle:Produit')->findOneByNom('FKL');
           $fmt=$em->getRepository('AppBundle:Produit')->findOneByNom('FMT');
           $supermatch=$em->getRepository('AppBundle:Produit')->findOneByNom('SUPER MATCH');
           $l_m=$em->getRepository('AppBundle:Produit')->findOneByNom('L-M');
           $dunhil=$em->getRepository('AppBundle:Produit')->findOneByNom('DUNHIL');
           $malboro=$em->getRepository('AppBundle:Produit')->findOneByNom('MALBORO');

     foreach ($objPHPExcel->getWorksheetIterator() as $feuille) {
         $highestRow  = $feuille->getHighestRow(); // e.g. 10
           for ($row = 2; $row <= $highestRow; ++ $row) {
             $telGerant = $feuille->getCellByColumnAndRow(0, $row)->getValue();
           $pointVente=$em->getRepository('AppBundle:PointVente')->findOneByTelGerant((string)$telGerant);
              $userId = $feuille->getCellByColumnAndRow(1, $row)->getFormattedValue();
           $user=$em->getRepository('AppBundle:Client')->findOneByUsername($userId);
            $date = $feuille->getCellByColumnAndRow(3, $row)->getFormattedValue();
            $mvj = $feuille->getCellByColumnAndRow(12, $row)->getFormattedValue();
            $ecl = $feuille->getCellByColumnAndRow(13, $row)->getFormattedValue();
            $map = $feuille->getCellByColumnAndRow(14, $row)->getFormattedValue();
            $pre = $feuille->getCellByColumnAndRow(15, $row)->getFormattedValue();
            $aff = $feuille->getCellByColumnAndRow(16, $row)->getFormattedValue();
            $rpd = $feuille->getCellByColumnAndRow(17, $row)->getFormattedValue();
            $rpp = $feuille->getCellByColumnAndRow(18, $row)->getFormattedValue();
            $exc = $feuille->getCellByColumnAndRow(19, $row)->getFormattedValue();
            $sapp = $feuille->getCellByColumnAndRow(20, $row)->getFormattedValue();
            $commentaire = $feuille->getCellByColumnAndRow(21, $row)->getFormattedValue();
            $visite=new Visite($user,null, new \DateTime($date),$pointVente,$aff,$sapp,$exc,$map,$pre,$rpd,$rpp,$commentaire,$mvj,$ecl);
            $visite->addSituation(new Situation($fks,$feuille->getCellByColumnAndRow(4, $row)->getValue()));
            $visite->addSituation(new Situation($fkm,$feuille->getCellByColumnAndRow(5, $row)->getValue()));
             $visite->addSituation(new Situation($fkl,$feuille->getCellByColumnAndRow(6, $row)->getValue())); 
             $visite->addSituation(new Situation($fmt,$feuille->getCellByColumnAndRow(7, $row)->getValue()));  
             $visite->addSituation(new Situation($supermatch,$feuille->getCellByColumnAndRow(8, $row)->getValue()));
             $visite->addSituation(new Situation($l_m,$feuille->getCellByColumnAndRow(9, $row)->getValue()));
             $visite->addSituation(new Situation($dunhil,$feuille->getCellByColumnAndRow(10, $row)->getValue())); 
             $visite->addSituation(new Situation($malboro,$feuille->getCellByColumnAndRow(11, $row)->getValue())); 
             $visite->setPointVente($pointVente);                    
             $em->persist($visite);
             $em->flush();
           }
            
         }
    
    return $this->redirectToRoute('user_homepage');      
    }         
}
