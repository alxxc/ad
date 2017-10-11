<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\{
    User,
    Ad,
    Tag
};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 30 users
        $users = [];
        for ($i = 0; $i < 30; $i++) {
            $manager->persist(
                $users[] = (new User())
                    ->setUsername("fixtureUser$i")
                    ->setPassword("fixturePassword$i")
                    ->setEmail("fixtureUser$i@local")
                    ->setFio("Family$i Name$i Surname$i")
            );
        }

        // create 30 tags
        $tags = [];
        for ($i = 0; $i < 30; $i++) {
            $manager->persist(
                $tags[] = (new Tag())
                    ->setTitle("fixture tag $i")
            );
        }

        // create 30 ads
        for ($i = 0; $i < 30; $i++) {
            $manager->persist(
                (new Ad())
                    ->setTitle("fixture tag $i")
                    ->setDescription(str_repeat("description$i ", rand(0, 200)))
                    ->setTheme("theme")
                    ->setUser($users[$i])
                    ->addTag($tags[$i])
            );
        }

        $manager->flush();
    }
}