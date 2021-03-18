<?php

namespace App\Repository;

use App\Entity\Gebruiker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @method Gebruiker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gebruiker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gebruiker[]    findAll()
 * @method Gebruiker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GebruikerRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    private $encoder;
    private $val;

    public function __construct(ManagerRegistry $registry,
                                UserPasswordEncoderInterface $encoder,
                                ValidatorInterface $val)
    {
        parent::__construct($registry, Gebruiker::class);
        $this->encoder = $encoder;
        $this->val = $val;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof Gebruiker) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

   public function getGebruiker($id) {
       $gebruiker = $this->find($id);
       return($gebruiker);
   }

   public function saveGebruiker($params) {
    
        if(isset($params['id'])) {
            $gebruiker = $this->find($params['id']);
        }
        else {
            $gebruiker = new Gebruiker();
        }

        if(isset($params['password'])) {
            $password = $this->encoder->encodePassword($gebruiker, $params['password']);
            $gebruiker->setPassword($password);
        }

        if(isset($params['roles'])) {
            $roles = $params['roles'];
            $gebruiker->setRoles($roles);
        }

        if(isset($params['voornaam'])) {
            $gebruiker->setVoornaam($params['voornaam']);
        }

        $gebruiker->setNaam($params['naam']);
        $gebruiker->setemail($params['email']);

        if(isset($params['geboortedatum'])) {
            $geboortedatum = \DateTime::createFromFormat('d-m-Y', $params['geboortedatum']);
            $gebruiker->setGeboortedatum($geboortedatum);
        }
        
        $gebruiker->setTelefoonnummer($params['telefoonnummer']);
        $gebruiker->setAdres($params['adres']);
        $gebruiker->setPostcode($params['postcode']);
        $gebruiker->setWoonplaats($params['woonplaats']);
        $gebruiker->setGebruikerBeschrijving($params['gebruikerBeschrijving']);
        
        if(isset($params['cv'])) {
            $gebruiker->setCv($params['cv']);
        }

        if(isset($params['cv_naam'])) {
            $gebruiker->setCvNaam($params['cv_naam']);
        }

        if(isset($params['profielfoto'])) {
            $gebruiker->setProfielfoto($params['profielfoto']);
        }

        $errors = $this->val->validate($gebruiker);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return ($errors);
        }

        $em = $this->getEntityManager();
        $em->persist($gebruiker);
        $em->flush();

        return false;
   }
}
