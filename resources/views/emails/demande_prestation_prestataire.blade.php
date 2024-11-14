<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle demande de prestation</title>
</head>
<body>
    <h1>Nouvelle demande de prestation</h1>
    <p>Bonjour {{ $prestataire->nom }},</p>

    <p>Vous avez reçu une nouvelle demande de prestation de la part de {{ $client->nom }}.</p>

    <p>Veuillez prendre contact avec le client pour plus de détails.</p>

    <p>Cordialement,</p>
    <p>L'équipe de notre plateforme</p>
</body>
</html>
