<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use App\Controller\BaseController;

/**
 * @Route("/")
 */
class HomepageController extends BaseController
{   
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function homepage()
    {
        $data = $this->vs->getAllVacatures();
        return array("data" => $data);
    }

    /**
     * @Route("/alleVacatures", name="alleVacatures")
     * @Template()
     */
    public function alleVacatures()
    {
        $data = $this->vs->getAllVacatures();
        return array("data" => $data);
    }

    /**
     * @Route("/vacature/{id}", name="detailpagina")
     * @Template()
     */
    public function detailpagina($id)
    {
        $data = $this->vs->getVacature($id);
        $bedrijf_id = $data->getBedrijf()->getId();
        $vacatures = $this->vs->getBedrijfVacatures($bedrijf_id);
        return array("data" => $data, "vacatures" => $vacatures);
    }

    /**
     * @Route("/registerKandidaat", name="registerKandidaat")
     * @Template()
     */
    public function register()
    {
        return array("data" => true);
    }

    /**
     * @Route("/saveProfiel", name="saveProfiel")
     */
    public function saveProfiel(Request $request)
    {
        $params = $request->request->all();
        $profiel = $this->ks->saveProfiel($params);
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/test", name="test")
     */
/*     public function homepage2()
    {
        $data = $this->ss->getAllVacatures2();
        dump($data);
        die();
        return array("data" => $data);
    } */
}
