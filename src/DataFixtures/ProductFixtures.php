<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Factory\ProductFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $product = new Product();
        $product->setProductName('Peluche pêche.');
        $product->setDescription('Magnifique peluche douce en forme de pêche. Elle saura vous tenir chaud et vous faire sourire avec ces petits pied et son large sourire.');
        $product->setPicturesUrls('https://www.lesbetisesdemalie.fr/41607-thickbox_default/peluche-peche-amuseable.jpg');
        $product->setStock(30);
        $product->setDisplay(true);
        $product->setPrice(30.5);

        $manager->persist($product);
        $manager->flush();
        $products = ProductFactory::createMany(10);
    }
}
