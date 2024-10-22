<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Royal+Luxurious&display=swap" rel="stylesheet">
    <style>
        .card {
            position: relative;
            overflow: hidden;
            border: none;
            background: none; /* Enlève le fond par défaut de la carte */
        }
        .card-content {
            position: relative; /* Changer pour que le texte soit en position relative */
            text-align: center;
            color: black; /* Changer la couleur du texte en noir */
            background: rgba(255, 255, 255, 0.5); /* Fond semi-transparent pour le texte */
            padding: 20px;
            border-radius: 8px;
            z-index: 2; /* S'assurer que le texte est au-dessus de l'image de fond */
        }
        .background-image {
            background-image: url('https://i.pinimg.com/control/564x/61/f3/47/61f3474a182795fde3254c02f60c4fab.jpg');
            background-size: cover; /* S'assurer que l'image couvre toute la zone */
            background-position: center; /* Centrer l'image de fond */
            background-repeat: no-repeat; /* Ne pas répéter l'image */
            position: absolute; /* Positionner l'image en arrière-plan */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1; /* S'assurer que l'image est derrière le texte */
        }
        @media (max-width: 768px) {
            .card-content {
                padding: 10px; /* Ajuster le padding pour les mobiles */
            }
            .invitation-name {
                font-size: 20px; /* Ajuster la taille de la police pour les mobiles */
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="h4">Invitation !</h1>
        <h6>Nous avons le plaisir de vous inviter à notre cérémonie.</h6>
        <div class="card">
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Invitation</title>
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Royal+Luxurious&display=swap" rel="stylesheet">
                <style>
                    .card {
                        position: relative;
                        overflow: hidden;
                        border: none;
                        background: none; /* Enlève le fond par défaut de la carte */
                    }
                    .card-content {
                        position: relative; /* Changer pour que le texte soit en position relative */
                        text-align: center;
                        color: black; /* Changer la couleur du texte en noir */
                        background: rgba(255, 255, 255, 0.5); /* Fond semi-transparent pour le texte */
                        padding: 20px;
                        border-radius: 8px;
                        z-index: 2; /* S'assurer que le texte est au-dessus de l'image de fond */
                    }
                    .background-image {
                        background-size: cover; /* S'assurer que l'image couvre toute la zone */
                        background-position: center; /* Centrer l'image de fond */
                        background-repeat: no-repeat; /* Ne pas répéter l'image */
                        position: absolute; /* Positionner l'image en arrière-plan */
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        z-index: 1; /* S'assurer que l'image est derrière le texte */
                    }
                    @media (max-width: 768px) {
                        .card-content {
                            padding: 10px; /* Ajuster le padding pour les mobiles */
                        }
                        .invitation-name {
                            font-size: 20px; /* Ajuster la taille de la police pour les mobiles */
                        }
                    }
                </style>
            </head>
            <body class="bg-light">
                <div class="container mt-5">
                    <h1 class="h4">Invitation !</h1>
                    <h6>Nous avons le plaisir de vous inviter à notre cérémonie.</h6>
                    <div class="card">
                        <div class="card-content">
                            <div class="card-content">
                            <p>{{ $carte->contenu }}</p> <!-- Contenu de la carte -->
                            <p class="invitation-name fw-bold">{{ $nom }}</p> <!-- Nom de l'invité affiché ici -->
                        </div>
                    </div>
                </div>
                {{-- <a href="{{ url('/invitation/accepter/' . $email) }}" class="btn btn-success">Accepter</a>
                <a href="{{ url('/invitation/refuser/' . $email) }}" class="btn btn-danger">Refuser</a> --}}

                {{-- <a href="{{ url('http://localhost:8000/invitation/accepter/' ) }}" class="btn btn-success">Accepter</a>
                <a href="{{ url('http://localhost:8000/invitation/refuser/' ) }}" class="btn btn-danger">Refuser</a> --}}
                <form action="{{ url('api/invitation/accepter/' . $invite->id) }}" method="POST" style="display: inline;">
                    @csrf <!-- Inclure le token CSRF pour la sécurité -->
                    <button type="submit" class="btn btn-success">Accepter</button>
                </form>
                
                <form action="{{ url('api/invitation/refuser/' . $invite->id) }}" method="POST" style="display: inline;">
                    @csrf <!-- Inclure le token CSRF pour la sécurité -->
                    <button type="submit" class="btn btn-danger">Refuser</button>
                </form>
                
            </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
