<?php

namespace App\Service;

use App\Entity\Sollicitatie;

use App\Service\VacatureService;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class SollicitatieService extends VacatureService {

    private $rep;
    private $security;

    public function __construct(EntityManagerInterface $em,
                                Security $security) {
        $this->rep=$em->getRepository(Sollicitatie::class);
        $this->security = $security;
    }

    public function getSollicitaties($id) {
        $sollicitaties = $this->rep->getSollicitaties($id);
        return($sollicitaties);
    }

    public function getVacatureSollicitaties($id) {
        $sollicitaties = $this->rep->getVacatureSollicitaties($id);
        return($sollicitaties);
    }

/*     public function getAllVacatures2(){
        $vacatures = $this->getAllVacatures();
        return($vacatures);
    } */

    public function saveSollicitatie($data) {

        $sollicitatie = $this->rep->saveSollicitatie($data);
        return($sollicitatie);
    }

    public function deleteSollicitatie($id) {
        $sollicitatie = $this->rep->deleteSollicitatie($id);
        return($sollicitatie);
    }

    public function uitnodigen($id) {
        $sollicitatie = $this->rep->uitnodigen($id);
        return($sollicitatie);
    }

}