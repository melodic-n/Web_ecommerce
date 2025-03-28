<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>

    <ul>
        @foreach ($produits as $produit)
            <li>{{ $produit->nom_prod }} - {{ $produit->prix }} €</li>
        @endforeach
    </ul>
</body>
</html>
