<!DOCTYPE html>
<html>
<head>
    <title>Demande de Prestation</title>
</head>
<body>
    <h1>Confirmation de votre demande de prestation</h1>
    <p>Bonjour {{ $client->nom }},</p>

    <p>Votre demande de prestation a bien été envoyée au prestataire {{ $prestataire->nom }}.</p>

    <p>Merci pour votre confiance.</p>

    <p>Cordialement,</p>
    <p>L'équipe de notre plateforme</p>
</body>
</html>
