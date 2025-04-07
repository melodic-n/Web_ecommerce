<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $produits = [
            [
                'nom_prod' => 'Pack: mini handy + 6 verres',
                'img_prod' => 'images/customer/Produit1.jpg',
                'prix' => 200,
                'description' => 'Un beau pack artisanal marocain.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Pack: cuillères, verre et assiette',
                'img_prod' => 'images/customer/Produit2.jpg',
                'prix' => 250,
                'description' => 'Service de table traditionnel.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Pack: tasses Weavy et assiettes',
                'img_prod' => 'images/customer/Produit3.jpg',
                'prix' => 150,
                'description' => 'Tasses tissées à la main.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Mug',
                'img_prod' => 'images/customer/Produit4.jpg',
                'prix' => 180,
                'description' => 'Mug traditionnel marocain.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Gobelets',
                'img_prod' => 'images/customer/Produit5.jpg',
                'prix' => 220,
                'description' => 'Gobelets artisanaux élégants.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Un pichet',
                'img_prod' => 'images/customer/Produit6.jpg',
                'prix' => 270,
                'description' => 'Pichet en terre cuite.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Assiettes',
                'img_prod' => 'images/customer/Produit7.jpg',
                'prix' => 230,
                'description' => 'Assiettes faites à la main.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Jarre en argile',
                'img_prod' => 'images/customer/Produit8.jpg',
                'prix' => 300,
                'description' => 'Jarre robuste en argile.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Bol',
                'img_prod' => 'images/customer/Produit9.jpg',
                'prix' => 210,
                'description' => 'Bol peint à la main.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Presse-agrumes',
                'img_prod' => 'images/customer/Produit10.jpg',
                'prix' => 190,
                'description' => 'Presse-agrumes artisanal.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Tagra',
                'img_prod' => 'images/customer/Produit11.jpg',
                'prix' => 190,
                'description' => 'Tagra pour la cuisson traditionnelle.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
            [
                'nom_prod' => 'Tabokalt',
                'img_prod' => 'images/customer/Produit12.jpg',
                'prix' => 190,
                'description' => 'Tabokalt fait main.',
                'quantite' => 10,
                'category' => 'Artisanat'
            ],
        ];

        foreach ($produits as $produit) {
            Produit::create($produit);
        }
    }

}
