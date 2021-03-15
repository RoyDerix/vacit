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

    public function findDuplicate($vacature_id, $kandidaat_id) {
        $sollicitatie = $this->rep->findDuplicate($vacature_id, $kandidaat_id);
        return($sollicitatie);
    }


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