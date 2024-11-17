<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' https://res.cloudinary.com data:; style-src 'self' 'unsafe-inline' https://stackpath.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
    <title>Confirmation Invitation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Royal+Luxurious&display=swap" rel="stylesheet">
    <style>
        .confirmation-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e9f2 100%);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            text-align: center;
            margin-top: 50px;
        }
        
        .icon-success {
            color: #28a745;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .icon-refuse {
            color: #dc3545;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .confirmation-title {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        .confirmation-message {
            color: #34495e;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .custom-button {
            padding: 0.8rem 2rem;
            font-size: 1.1rem;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .custom-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .background-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(0,0,0,0.1) 2%, transparent 0%),
                radial-gradient(circle at 75px 75px, rgba(0,0,0,0.1) 2%, transparent 0%);
            background-size: 100px 100px;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="background-pattern"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="confirmation-card">
                    @if($statut === 'accepte')
                        <div class="icon-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </div>
                        <h1 class="confirmation-title">Merci d'avoir accepté l'invitation !</h1>
                        <p class="confirmation-message">Nous avons bien enregistré votre réponse et nous nous réjouissons de vous compter parmi nous.</p>
                    @else
                        <div class="icon-refuse">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <h1 class="confirmation-title">Nous avons bien reçu votre réponse</h1>
                        <p class="confirmation-message">Nous regrettons que vous ne puissiez pas être des nôtres, mais nous comprenons votre décision.</p>
                    @endif
                    
                    <a href="{{ url('https://wadial-sa-beuss-front.vercel.app/acceuil') }}" class="btn btn-primary custom-button">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>