<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
</head>
<body>
    <h1>Liste des Produits</h1>

    @if($produits->isEmpty())
        <p>Aucun produit disponible.</p>
    @else
        <ul>
            @foreach ($produits as $produit)
                <li>
                    <strong>{{ $produit->nom_prod }}</strong><br>
                    <img src="{{ asset('storage/' . $produit->img_prod) }}" alt="{{ $produit->nom_prod }}" style="width: 100px; height: 100px;"><br>
                    <p>Description: {{ $produit->description }}</p>
                    <p>Prix: {{ $produit->prix }} €</p>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
