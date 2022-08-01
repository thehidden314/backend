<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $names = ['moussa','mamadou','diockel'];
        $lastname  = ['niass','ndao','ndiaye'];
        $i = 1;
        while ($i <=3) {
            $user = new User();
            $user->setPrenom($names[rand(0, 2)])
                ->setNom($lastname[rand(0, 2)])
                ->setEmail('mail'.$i.'@mail.sn')
                ->setPassword($this->hasher->hashPassword($user, 'passer123'))
                ->setRoles(['ROLES_ADMIN']);
                $manager->persist($user);
            $i++;
        }
    

        $manager->flush();
    }
}
