<?php

namespace App\DataFixtures;

use App\Entity\Article;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nbArticles = 20;
        for ($i = 0; $i <  $nbArticles; $i++) {
            $article = new Article();
            $article->setName('Article n°'. strval($i+1));
            $article->setPrice(round(random_int(40, 200)/($i+1),2));
            $article->setStock($i + 10);
            $article->setDescription($lipsum = simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=paras&start=0')->lipsum);
            $article->setLikes(random_int(0, 10));
            $article->setReference(Uuid::v4());

            $manager->persist($article);
         }

        $manager->flush();
    }
}
