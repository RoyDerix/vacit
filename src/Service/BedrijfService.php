<?php

namespace App\Service;

use App\Entity\Gebruiker;

use Doctrine\ORM\EntityManagerInterface;

class BedrijfService {

    private $rep;

    public function __construct(EntityManagerInterface $em) {
        $this->rep=$em->getRepository(Gebruiker::class);
    }

    public function getBedrijf($id) {
        $bedrijf = $this->rep->getGebruiker($id);
        return($bedrijf);
    }

    public function saveProfiel($params) {
        $gebruiker = $this->rep->saveGebruiker($params);
        return($gebruiker);
    }
}