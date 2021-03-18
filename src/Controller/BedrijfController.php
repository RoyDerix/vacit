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
        $user = $this->getUser();
        $user_id = $user->getId();
        if($id == 0){
            $id = $user_id;
        }
        
        if($user_id == $id || $this->isGranted('ROLE_ADMIN') ) {
            $data = $this->ks->getKandidaat($id);
            return array("data" => $data);
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/updateBedrijfProfiel/{id}", name="updateBedrijfProfiel")
     * @Template()
     */
    public function updateProfiel($id)
    {
        $user = $this->getUser();
        $user_id = $user->getId();
        if($user_id == $id || $this->isGranted('ROLE_ADMIN')) {
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

        if(!$profiel) {
            return $this->redirectToRoute('showBedrijfProfiel', ['id' => $params['id']]);
        }

        $this->addFlash('notice', $profiel);
        return $this->redirectToRoute('updateBedrijfProfiel', ['id' => $params['id']]);
    }

    /**
     * @Route("/showMijnVacatures/{id}", name="showMijnVacatures")
     * @Template
    */
    public function showVacatures($id)
    {
        $user = $this->getUser();
        $user_id = $user->getId();
        if($id == 0){
            $id = $user_id;
        }
        
        if($user_id == $id || $this->isGranted('ROLE_ADMIN') ) {
            $data = $this->vs->getMyVacatures($id);
            $vacatures = $data['vacatures'];
            $sollicitaties = $data['sollicitaties'];
            return array("vacatures" => $vacatures, 'sollicitaties' => $sollicitaties);
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/showSollicitantProfiel/{id}", name="showSollicitantProfiel")
     * @Template()
     */
    public function showSollicitantProfiel($id)
    {
        $data = $this->ks->getKandidaat($id);
        return array("data" => $data);
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
        $bedrijf_id = $data->getBedrijf()->getId();
        $user = $this->getUser();
        $user_id = $user->getId();
        if($user_id == $bedrijf_id || $this->isGranted('ROLE_ADMIN')) {

            return array("data" => $data, "niveaus" => $niveaus, "platforms" => $platforms);
        }

        return $this->redirectToRoute('showMijnVacatures', ['id' => $user_id]);
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

        $vacature = $this->vs->getVacature($id);
        $bedrijf_id = $vacature->getBedrijf()->getId();

        $user = $this->getUser();
        $user_id = $user->getId();

        if($user_id == $bedrijf_id || $this->isGranted('ROLE_ADMIN')) {

            $delete = $this->vs->deleteVacature($id);
        }

        return $this->redirectToRoute('showMijnVacatures', ['id' => $user_id]);
    }

    /**
     * @Route("/uitnodigen", name="uitnodigen")
    */
    public function uitnodigen(Request $request)
    {
        $id = $request->request->get('id');
        $sollicitatie = $this->ss->uitnodigen($id);
        return($sollicitatie);
    } 
}