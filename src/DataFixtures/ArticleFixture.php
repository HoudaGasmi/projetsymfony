<?php

namespace App\DataFixtures;
use App\Entity\Categorie;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <5; $i++){
            $category = new Categorie();
            $category->setTitle("article $i");
            $category->setDescription("description $i");

            $manager->persist($category);

            for ($j=1; $j <=2 ; $j++) { 
                $article=new Article();
                $article->setTitle("title $j")
                       ->setContent("hhhhhhhhhhhhhhhhhhhhhhhhhh")
                       ->setCreatedat(new \DateTime())
                       ->setImage("https://picsum.photos/seed/picsum/300/150")
                       ->setCategory($category);
            
                       $manager->persist($article);

            }

        }

        

        $manager->flush();
    }
}
