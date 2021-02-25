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
        $data = $this->ks->getKandidaat($id);
        dump($data);
        die();
        //return array("data" => $data);
    }

    /**
     * @Route("/updateKandidaatProfiel/{id}", name="updateKandidaatProfiel")
     * @Template()
     */
    public function updateProfiel($id)
    {
        $user = $this->getUser();
        $user_id = $user->getId();
        if($user_id == $id) {
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
        return $this->redirectToRoute('showKandidaatProfiel', ['id' => $params['id']]);
    }

    /**
     * @Route("/showSollicitaties/{id}", name="showSollicitaties")
     * @Template()
     */
    public function showSollicitaties($id)
    {
        $data = $this->ss->getSollicitaties($id);
        dump($data);
        die();
        //return array("data" => $data);
    }

    /**
     * @Route("/saveSollicitatie", name="saveSollicitatie")
     */
    public function saveSollicitatie($vacature_id, $kandidaat_id)
    {
        $date = new \DateTime();
        $params = array("vacature" => $vacature_id,
                        "uitgenodigd" => "FALSE",
                        "sollicitatie_datum" => $date,
                        "kandidaat" => $kandidaat_id);
        
        $this->ss->saveSollicitatie($params);
    }
}
