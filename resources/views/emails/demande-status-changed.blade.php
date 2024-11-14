<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre demande</title>
</head>
<body>
    <h1>Bonjour {{ $demande->client->nom }},</h1>
    <p>Votre demande de prestation avec le prestataire {{ $prestataireNom }} a été mise à jour.</p> <!-- Utilisez la variable $prestataireNom directement -->
    <p>Statut actuel de la demande : <strong>{{ $etat }}</strong></p>
    <p>Merci d'avoir choisi notre service.</p>
    <p>Cordialement,<br>
    L'équipe de WadialSaBeuss.
    <img src="" alt="">
</p>
</body>
</html>