<!DOCTYPE html>
<html>
<head>
    <title>Demande de Prestation</title>
</head>
<body>
    <p>Bonjour {{ $client->nom }},</p>

    <p>Votre demande de prestation a bien été envoyée au prestataire {{ $prestataire->nom }}.Nous vous renevons sous peu .</p>

    <p>Merci pour votre confiance.</p>

    <p>Cordialement,</p>
</body>
</html>
