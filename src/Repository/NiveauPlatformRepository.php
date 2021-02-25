<?php

namespace App\Repository;

use App\Entity\NiveauPlatform;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NiveauPlatform|null find($id, $lockMode = null, $lockVersion = null)
 * @method NiveauPlatform|null findOneBy(array $criteria, array $orderBy = null)
 * @method NiveauPlatform[]    findAll()
 * @method NiveauPlatform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauPlatformRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NiveauPlatform::class);
    }

    public function getAllNiveaus() {

        $niveaus = $this->findBy(array("record_type" => "N"));
        return($niveaus);
    }

    public function getAllPlatforms() {

        $platforms = $this->findBy(array("record_type" => "P"));
        return($platforms);
    }

    public function getNiveauPlatform($id) {
        $niveauPlatform = $this->find($id);
        return($niveauPlatform);
    }
}
