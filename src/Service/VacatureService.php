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

    public function getBedrijfVacatures($id) {

        $vacatures = $this->rep->getMyVacatures($id);
        return($vacatures);
    }

    public function getMyVacatures($id) {
        $data = [];
        $vacatures = [];
        $sollicitaties = [];
        $vacatures = $this->rep->getMyVacatures($id);
        foreach($vacatures as $vacature) {
            $vacature_id = $vacature->getId();
            $dezeSollicitaties = $this->ss->getVacatureSollicitaties($vacature_id);
            foreach($dezeSollicitaties as $sollicitatie) {
                $sollicitaties [] = $sollicitatie;
            }
        }

        $data = ['vacatures' => $vacatures, 'sollicitaties' => $sollicitaties];
        return($data);
    }

    public function saveVacature($params){
        if(isset($params['plaatsingsDatum'])) {
            $datum = \DateTime::createFromFormat('d-m-Y', $params['plaatsingsDatum']);
        }
        else {
            $datum = new \DateTime();
        }
        $niveau = $this->nps->getNiveauPlatform($params['niveau']);
        $platform = $this->nps->getNiveauPlatform($params['platform']);
        $bedrijf = $this->bs->getBedrijf($params['bedrijf_id']);
        $vacatureBeschrijving = strip_tags($params['vacatureBeschrijving'], '<br><b><i><div>');
        $vacatureBeschrijving = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $vacatureBeschrijving);
        
        $id = null;
        if(isset($params['id'])) {
            $id = $params['id'];
        }

        $data = array(
                    "id" => $id,
                    "niveau" => $niveau,
                    "platform" => $platform,
                    "titel" => $params['titel'],
                    "standplaats" => $params['standplaats'],
                    "vacatureBeschrijving" => $vacatureBeschrijving,
                    "plaatsingsDatum" => $datum,
                    "bedrijf" => $bedrijf
        );

        $vacature = $this->rep->saveVacature($data);
        return($vacature);
    }
    
    public function deleteVacature($id) {
        $sollicitaties = $this->ss->getVacatureSollicitaties($id);
        foreach($sollicitaties as $sollicitatie) {
            $this->ss->deleteSollicitatie($sollicitatie->getId());
        }
        $vacature = $this->rep->deleteVacature($id);
        return($vacature);
    }


    public function saveSollicitatie($id) {

        $date = new \DateTime();
        $vacature = $this->getVacature($id);
        $kandidaat = $this->security->getUser();
        $duplicate = $this->ss->findDuplicate($id, $kandidaat->getId());
        if(!$duplicate) {
            $data = array(
                        "vacature" => $vacature,
                        "uitgenodigd" => FALSE,
                        "sollicitatieDatum" => $date,
                        "kandidaat" => $kandidaat
            );

            $sollicitatie = $this->ss->saveSollicitatie($data);
            return($sollicitatie);
        }

        else{
            return('duplicate');
        }
    }


}
