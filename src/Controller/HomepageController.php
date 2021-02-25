<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        //dump($data);
        //die();
        return array("data" => $data);
    }

    /**
     * @Route("/vacature/{id}", name="detailpagina")
     * @Template()
     */
    public function detailpagina($id)
    {
        $data = $this->vs->getVacature($id);
/*         dump($data);
        die(); */
        return array("data" => $data);
    }
}
