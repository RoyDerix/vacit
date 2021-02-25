<?php

namespace App\Service;

use App\Entity\NiveauPlatform;

use Doctrine\ORM\EntityManagerInterface;

class NiveauPlatformService {

    private $rep;

    public function __construct(EntityManagerInterface $em) {
        $this->rep=$em->getRepository(NiveauPlatform::class);
    }

    public function getAllNiveaus() {
        $niveaus = $this->rep->getAllNiveaus();
        return($niveaus);
    }

    public function getAllPlatforms() {
        $platforms = $this->rep->getAllPlatforms();
        return($platforms);
    }

    public function getNiveauPlatform($id) {
        $niveauPlatform = $this->rep->getNiveauPlatform($id);
        return($niveauPlatform);
    }

}