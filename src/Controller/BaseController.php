<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Service\BedrijfService;
use App\Service\KandidaatService;
use App\Service\SollicitatieService;
use App\Service\VacatureService;
use App\Service\NiveauPlatformService;

class BaseController extends AbstractController
{
    protected $bs;
    protected $ks;
    protected $ss;
    protected $vs;
    protected $nps;
    protected $val;
    
    public function __construct(BedrijfService $bs,
                                KandidaatService $ks,
                                SollicitatieService $ss,
                                VacatureService $vs,
                                NiveauPlatformService $nps,
                                ValidatorInterface $val) {
        $this->bs = $bs;
        $this->ks = $ks;
        $this->ss = $ss;
        $this->vs = $vs;
        $this->nps = $nps;  
        $this->val = $val;
    }
}
