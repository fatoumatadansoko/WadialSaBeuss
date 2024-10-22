<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <h1>Confirmation</h1>
    @if (session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <a href="{{ url('/') }}">Retour à l'accueil</a>
</body>
</html>
