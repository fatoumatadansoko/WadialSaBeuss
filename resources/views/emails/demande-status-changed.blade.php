<!DOCTYPE html>
<html>
<head>
    <title>Mise à jour de votre demande</title>
</head>
<body>
    <h1>Bonjour {{ $demande->client->nom }},</h1> <!-- Affiche le nom du client -->

    <p>Votre demande de prestation avec le prestataire {{ $demande->prestataire->nom }} a été mise à jour.</p> <!-- Affiche le nom du prestataire -->

    <p>Statut actuel de la demande : <strong>{{ $etat }}</strong></p> <!-- Affiche l'état de la demande -->

    <p>Merci d'avoir choisi notre service.</p>

    <p>Cordialement,<br>
    L'équipe de WadialSaBeuss.</p>
</body>
</html>
