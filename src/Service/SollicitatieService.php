<?php

namespace App\Service;

use App\Entity\Sollicitatie;

use Doctrine\ORM\EntityManagerInterface;

class SollicitatieService {

    private $rep;

    public function __construct(EntityManagerInterface $em) {
        $this->rep=$em->getRepository(Sollicitatie::class);
    }

    public function getSollicitaties($id) {
        $sollicitaties = $this->rep->getSollicitaties($id);
        return($sollicitaties);
    }



}