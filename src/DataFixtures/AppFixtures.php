<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\CouponCode;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $couponCode = new CouponCode();
        $couponCode->setCodeName('15% discount');
        $couponCode->setCode('15_OFF');
        $couponCode->setDiscount(15);
        $couponCode->setCreateddate(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $manager->persist($couponCode);

        $manager->flush();
    }
}
