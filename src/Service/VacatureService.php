<?php

namespace App\Service;

use App\Entity\Vacature;
use App\Service\NiveauPlatformService;
use App\Service\BedrijfService;
use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\EntityManagerInterface;

class VacatureService {

    private $rep;
    private $nps;
    private $bs;
    private $security;

    public function __construct(EntityManagerInterface $em,
                                BedrijfService $bs,
                                NiveauPlatformService $nps,
                                Security $security) {
        $this->rep=$em->getRepository(Vacature::class);
        $this->bs = $bs;
        $this->nps = $nps;
        $this->security = $security;

    }
    
    public function getAllVacatures() {
        $vacatures = $this->rep->getAllVacatures();
        return($vacatures);
    }

    public function getVacature($id) {
        $vacature = $this->rep->getVacature($id);
        return($vacature);
    }

    public function getMyVacatures($id) {
        $vacatures = $this->rep->getMyVacatures($id);
        return($vacatures);
    }

    public function saveVacature($params){
        $datum = new \DateTime();
        $niveau = $this->nps->getNiveauPlatform($params['niveau']);
        $platform = $this->nps->getNiveauPlatform($params['platform']);
        $bedrijf = $this->security->getUser();

        $data = array(
                    "niveau" => $niveau,
                    "platform" => $platform,
                    "titel" => $params['titel'],
                    "standplaats" => $params['standplaats'],
                    "vacatureBeschrijving" => $params['vacatureBeschrijving'],
                    "plaatsingsDatum" => $datum,
                    "bedrijf" => $bedrijf
        );

        $vacature = $this->rep->saveVacature($data);
        return($vacature);
    }
}
