<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' https://res.cloudinary.com;">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' https://res.cloudinary.com data:; style-src 'self' 'unsafe-inline' https://stackpath.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; script-src 'self' https://code.jquery.com https://cdn.jsdelivr.net;">
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
            background-image: url('https://res.cloudinary.com/dodvioas8/image/upload/v1731505407/FREE_Printable_-_Classy_Pink_and_Blue_Floral_Bridal_Shower_Invitation_Templates___Beeshower_gio4ts.jpg');
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
        <div class="card">
            <div class="card-content">
                <div class="card-content">
                    <p>{{ $carte->contenu }}</p>
                    <p class="invitation-name fw-bold">{{ $nom }}</p>
                    
                    {{-- <img src="{{ $image }}" class="carte-image" alt="Image de la carte" onerror="this.onerror=null; this.src='{{ asset($image) }}';"> --}}
                </div>
            </div>
            <p><a href="{{ url('api/cartes-personnalisees/{id}/' . $token) }}">Télécharger ma carte d'invitation</a></p>

        </div>
    </div>

    @if(isset($token))
        <form action="{{ url('api/invitation/accepter/' . $token) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-success">Accepter</button>
        </form>
        
        <form action="{{ url('api/invitation/refuser/' . $token) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Refuser</button>
        </form>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
              
</html>
