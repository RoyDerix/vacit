<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Controller\BaseController;

/**
 * @Route("/backoffice/kandidaat")
 */

class KandidaatController extends BaseController
{
    /**
     * @Route("/showKandidaatProfiel/{id}", name="showKandidaatProfiel")
     * @Template()
     */
    public function showProfiel($id)
    {
        $user = $this->getUser();
        $user_id = $user->getId();
        
        if($user_id == $id || $this->isGranted('ROLE_ADMIN')) {
            $data = $this->ks->getKandidaat($id);
            return array("data" => $data);
        }
        return $this->redirectToRoute('showKandidaatProfiel', ['id' => $user_id]);
    }

    /**
     * @Route("/updateKandidaatProfiel/{id}", name="updateKandidaatProfiel")
     * @Template()
     */
    public function updateProfiel($id)
    {
        $user = $this->getUser(); 
        $user_id = $user->getId();
        if($user_id == $id || $this->isGranted('ROLE_ADMIN')) {
            $data = $this->ks->getKandidaat($id);
            return array("data" => $data);
        }
        return $this->redirectToRoute('showKandidaatProfiel', ['id' => $user_id]);
    }

    /**
     * @Route("/saveKandidaatProfiel", name="saveKandidaatProfiel")
     */
    public function saveProfiel(Request $request)
    {
        $params = $request->request->all();
        $profiel = $this->ks->saveProfiel($params);
        $user = $this->getUser();
        $user_id = $user->getId();
        return $this->redirectToRoute('showKandidaatProfiel', ['id' => $user_id]);
    }

    /**
     * @Route("/showSollicitaties/{id}", name="showSollicitaties")
     * @Template()
     */
    public function showSollicitaties($id)
    {
        $user = $this->getUser();
        $user_id = $user->getId();
        if($id == 0){
            $id = $user_id;
        }
        
        if($user_id == $id || $this->isGranted('ROLE_ADMIN') ) {
            $data = $this->ss->getSollicitaties($id);
            return array("data" => $data);
        }
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/showWerkgeverProfiel/{id}", name="showWerkgeverProfiel")
     * @Template()
     */
    public function showWerkgeverProfiel($id)
    {
        $data = $this->ks->getKandidaat($id);
        return array("data" => $data);
    }


    /**
     * @Route("/saveSollicitatie/{id}", name="saveSollicitatie")
     */
    public function saveSollicitatie($id)
    {   
        $user = $this->getUser();
        $user_id = $user->getId();
        $sollicitatie = $this->vs->saveSollicitatie($id);
        return $this->redirectToRoute('showSollicitaties', ['id' => $user_id]);

    }

    /**
     * @Route("/deleteSollicitatie/{id}", name="deleteSollicitatie")
    */
    public function deleteSollicitatie($id)
    {
        $sollicitatie = $this->ss->deleteSollicitatie($id);
        $user = $this->getUser();
        $user_id = $user->getId();
        return $this->redirectToRoute('showSollicitaties', ['id' => $user_id]);
    }
}
