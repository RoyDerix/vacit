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
        $user = $this->getUser();
        $user_id = $user->getId();
        if($user_id == $id) {
            $data = $this->bs->getBedrijf($id);
            return array("data" => $data);
        }
        return $this->redirectToRoute('showBedrijfProfiel', ['id' => $user_id]);
    }

    /**
     * @Route("/saveBedrijfProfiel", name="saveBedrijfProfiel")
     */
    public function saveProfiel(Request $request)
    {
        $params = $request->request->all();
        $profiel = $this->bs->saveProfiel($params);
        return $this->redirectToRoute('showBedrijfProfiel', ['id' => $params['id']]);
    }

    /**
     * @Route("/showMijnVacatures/{id}", name="showMijnVacatures")
    */
    public function showVacatures($id)
    {
        $vacatures = $this->vs->getMyVacatures($id);
        dump($vacatures);
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
     * @Route("/editVacature/{id}", name="editVacature")
     * @Template()
    */
    public function editVacature($id) {
        $niveaus = $this->nps->getAllNiveaus();
        $platforms = $this->nps->getAllPlatforms();
        $data = $this->vs->getVacature($id);

        return array("data" => $data, "niveaus" => $niveaus, "platforms" => $platforms);
    }

    /**
     * @Route("/saveVacature", name="saveVacature")
    */
    public function saveVacature(Request $request)
    {
        $params = $request->request->all();
        $vacature = $this->vs->saveVacature($params);
        $bedrijf = $this->getUser();
        $bedrijf_id = $bedrijf->getId();
        return $this->redirectToRoute('showMijnVacatures', ['id' => $bedrijf_id]);
    } 

    /**
     * @Route("/deleteVacature/{id}", name="deleteVacature")
    */
    public function deleteVacature($id)
    {
        $vacature = $this->vs->deleteVacature($id);
        $bedrijf = $this->getUser();
        $bedrijf_id = $bedrijf->getId();
        return $this->redirectToRoute('showMijnVacatures', ['id' => $bedrijf_id]);
    }

    /**
     * @Route("/uitnodigen/{id}", name="uitnodigen")
    */
    public function uitnodigen($id)
    {
        $sollicitatie = $this->ss->uitnodigen($id);
        $bedrijf = $this->getUser();
        $bedrijf_id = $bedrijf->getId();
        return $this->redirectToRoute('showMijnVacatures', ['id' => $bedrijf_id]);
    } 
}