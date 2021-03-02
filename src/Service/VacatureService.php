<?php

namespace App\Service;

use App\Entity\Vacature;
use App\Service\NiveauPlatformService;
use App\Service\BedrijfService;
use App\Service\SollicitatieService;
use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\EntityManagerInterface;

class VacatureService {

    private $rep;
    private $nps;
    private $bs;
    private $ss;
    private $security;

    public function __construct(EntityManagerInterface $em,
                                BedrijfService $bs,
                                NiveauPlatformService $nps,
                                SollicitatieService $ss,
                                Security $security) 
    {
        $this->rep=$em->getRepository(Vacature::class);
        $this->bs = $bs;
        $this->nps = $nps;
        $this->ss = $ss;
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
        $data = [];
        $vacatures = $this->rep->getMyVacatures($id);
        foreach($vacatures as $vacature) {
            $vacature_id = $vacature->getId();
            $sollicitaties = $this->ss->getVacatureSollicitaties($vacature_id);
            $thisdata = ["vacature" => $vacature,
                        "sollicitaties" => $sollicitaties];
            $data[] = $thisdata;
        }
        return($data);
    }

    public function saveVacature($params){
        $datum = new \DateTime();
        $niveau = $this->nps->getNiveauPlatform($params['niveau']);
        $platform = $this->nps->getNiveauPlatform($params['platform']);
        $bedrijf = $this->security->getUser();
        $id = "";
        if(isset($params['id'])) {
            $id = $params['id'];
        }

        $data = array(
                    "id" => $id,
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
    
    public function deleteVacature($id) {
        $vacature = $this->rep->deleteVacature($id);
        return($vacature);
    }


    public function saveSollicitatie($id) {

        $date = new \DateTime();
        $vacature = $this->getVacature($id);
        $kandidaat = $this->security->getUser();
        $data = array(
                    "vacature" => $vacature,
                    "uitgenodigd" => "FALSE",
                    "sollicitatieDatum" => $date,
                    "kandidaat" => $kandidaat
        );

        $sollicitatie = $this->ss->saveSollicitatie($data);
        return($sollicitatie);
    }


}
