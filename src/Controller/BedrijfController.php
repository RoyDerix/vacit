<?php

namespace App\Controller;

use App\Entity\Gebruiker;
use App\Entity\Vacature;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use App\Controller\BaseController;

/**
 * @Route("/backoffice/bedrijf")
*/

class BedrijfController extends BaseController
{
    /**
     * @Route("/showBedrijfProfiel/{id}", name="showBedrijfProfiel")
     * @Template()
    */
    public function showProfiel($id)
    {
        $data = $this->bs->getBedrijf($id);
        dump($data);
        die();
        //return array("data" => $data);
    }

    /**
     * @Route("/updateBedrijfProfiel/{id}", name="updateBedrijfProfiel")
     * @Template()
    */
    public function updateProfiel($id)
    {
        $data = $this->ks->getBedrijf($id);
        dump($data);
        die();
        //return array("data" => $data);
    }


    /**
     * @Route("/showMijnVacatures/{id}", name="showMijnVacatures")
     * @Template()
    */
    public function showVacatures($id)
    {
        $data = $this->vs->getMyVacatures($id);
        dump($data);
        die();
        //return array("data" => $data);
    }

    /**
     * @Route("/newVacature", name="newVacature")
     * @Template()
    */
    public function newVacature() {
        $niveaus = $this->nps->getAllNiveaus();
        $platforms = $this->nps->getAllPlatforms();
        return array("niveaus" => $niveaus, "platforms" => $platforms);
    }

    /**
     * @Route("/saveVacature", name="saveVacature")
    */
    public function saveVacature(Request $request)
    {
        $params = $request->request->all();
        $vacature = $this->vs->saveVacature($params);
        $id = $vacature->getId();
        return $this->redirectToRoute('detailpagina', ['id' => $id]);
    } 
}