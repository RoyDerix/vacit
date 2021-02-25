<?php

namespace App\Service;

use App\Entity\Gebruiker;

use Doctrine\ORM\EntityManagerInterface;

class KandidaatService {

    private $rep;

    public function __construct(EntityManagerInterface $em) {
        $this->rep=$em->getRepository(Gebruiker::class);
    }

    public function getKandidaat($id) {
        $kandidaat = $this->rep->getGebruiker($id);
        return($kandidaat);
    }

    public function saveProfiel($params) {
        $gebruiker = $this->rep->saveGebruiker($params);
        return($gebruiker);
    }
}