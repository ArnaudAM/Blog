<?php

namespace App\DataFixtures;

use App\Service\Slugify;
use Faker;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $article = new Article();
            $faker = Faker\Factory::create('fr_FR');
            $article->setTitle(mb_strtolower($faker->sentence()));
            $article->setContent($faker->text(50));
            $article->setSlug($this->slug->generate($article->getTitle()));

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_' . rand(0, 4)));
        }
        $manager->flush();
    }

}