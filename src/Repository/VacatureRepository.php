<?php

namespace App\Repository;

use App\Entity\Vacature;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vacature|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacature|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacature[]    findAll()
 * @method Vacature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vacature::class);
    }

    public function getAllVacatures() {
        $vacatures = $this->findAll();
        return($vacatures);
    }

    public function getVacature($id) {
        $vacature = $this->find($id);
        return($vacature);
    }

    public function getMyVacatures($id) {
        $vacatures = $this->findBy(array("bedrijf" => $id));
        return($vacatures);
    }

    public function saveVacature($params) {
        

        if(isset($params['id'])) {
            $vacature = $this->find($params['id']);
        }
        else {
            $vacature = new Vacature();
        }

        $vacature->setNiveau($params['niveau']);
        $vacature->setPlatform($params['platform']);
        $vacature->setTitel($params['titel']);
        $vacature->setstandplaats($params['standplaats']);
        $vacature->setVacatureBeschrijving($params['vacatureBeschrijving']);
        $vacature->setPlaatsingsDatum($params['plaatsingsDatum']);
        $vacature->setBedrijf($params['bedrijf']);

        $em = $this->getEntityManager();
        $em->persist($vacature);
        $em->flush();

        return($vacature);
    }

    public function deleteVacature($id) {

        $vacature = $this->find($id);

        $em = $this->getEntityManager();
        $em->remove($vacature);
        $em->flush();

        return("Deleted vacature nr. $id");

    }
}
