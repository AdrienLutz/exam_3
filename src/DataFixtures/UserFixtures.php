<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
//        $User = new User();
//        $User->setEmail("user@user.fr");
//        $User->setRoles(["ROLE_USER"]);
//        $encodedPassword = $this->hasher->hashPassword($User, "user");
//        $User->setPassword($encodedPassword);
//        $User->setNom("user");
//        $User->setPrénom("user");
//        $User->setPhoto("uploads/batman.jpg");
//        $User->setContrat("CDI");
//        $User->setSecteur("Informatique");
//        $User->setDateSortie("");

        $Admin_rh = new User();
        $Admin_rh->setEmail("rh@humanbooster.com");
        $Admin_rh->setRoles(["ROLE_RH"]);
        $encodedPassword = $this->hasher->hashPassword($Admin_rh, "rh123@");
        $Admin_rh->setPassword($encodedPassword);
        $Admin_rh->setNom("Admin_rh");
        $Admin_rh->setPrénom("user");
        $Admin_rh->setPhoto("uploads/joker.jpg");
        $Admin_rh->setContrat("CDI");
        $Admin_rh->setSecteur("RH");
//        $Admin_rh->setDateSortie("03/05/32");

//        $manager->persist($User);
        $manager->persist($Admin_rh);

        $manager->flush();
    }

}
