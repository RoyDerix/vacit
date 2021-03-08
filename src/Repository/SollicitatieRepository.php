<?php

namespace App\Repository;

use App\Entity\Sollicitatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sollicitatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sollicitatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sollicitatie[]    findAll()
 * @method Sollicitatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SollicitatieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sollicitatie::class);
    }

    public function getSollicitaties($id) {
        $sollicitaties = $this->findBy(array("kandidaat" => $id));
        return($sollicitaties);
    }

    public function getVacatureSollicitaties($id) {
        $sollicitaties = $this->findBy(array("vacature" => $id));
        return($sollicitaties);
    }

    public function saveSollicitatie($params) {

        $sollicitatie = new Sollicitatie();

        $sollicitatie->setVacature($params['vacature']);
        $sollicitatie->setUitgenodigd($params['uitgenodigd']);
        $sollicitatie->setSollicitatieDatum($params['sollicitatieDatum']);
        $sollicitatie->setKandidaat($params['kandidaat']);

        $em = $this->getEntityManager();
        $em->persist($sollicitatie);
        $em->flush();

        return($sollicitatie);
    }

    public function deleteSollicitatie($id) {

        $sollicitatie = $this->find($id);

        $em = $this->getEntityManager();
        $em->remove($sollicitatie);
        $em->flush();

        return("Deleted sollicitatie nr. $id");
    }

    public function uitnodigen($id) {
        $sollicitatie = $this->find($id);
        $uitgenodigd = $sollicitatie->getUitgenodigd();
        if($uitgenodigd == TRUE) {
            $sollicitatie->setUitgenodigd(FALSE);
        }    
        else{
            $sollicitatie->setUitgenodigd(TRUE);
        }

        $em = $this->getEntityManager();
        $em->persist($sollicitatie);
        $em->flush();

        return($sollicitatie);
    }
}
