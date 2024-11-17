// resources/views/erreur.blade.php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' https://res.cloudinary.com data:; style-src 'self' 'unsafe-inline' https://stackpath.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
    <title>Erreur - Invitation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .error-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 50px;
            text-align: center;
        }
        
        .error-icon {
            color: #dc3545;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .error-title {
            color: #dc3545;
            margin-bottom: 1rem;
        }
        
        .error-message {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .return-button {
            background-color: #0d6efd;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .return-button:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="error-card">
                    <div class="error-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                        </svg>
                    </div>
                    <h1 class="error-title">Oups !</h1>
                    <p class="error-message">{{ $message }}</p>
                    <a href="{{ url('/') }}" class="return-button">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

// resources/views/confirmation.blade.php
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' https://res.cloudinary.com data:; style-src 'self' 'unsafe-inline' https://stackpath.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com;">
    <title>Confirmation - Invitation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .confirmation-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 50px;
            text-align: center;
        }
        
        .success-icon {
            color: #198754;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .refuse-icon {
            color: #dc3545;
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .confirmation-title {
            color: #212529;
            margin-bottom: 1rem;
        }
        
        .confirmation-message {
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        .return-button {
            background-color: #0d6efd;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .return-button:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="confirmation-card">
                    @if($statut === 'accepte')
                        <div class="success-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                        </div>
                        <h1 class="confirmation-title">Merci d'avoir accepté l'invitation !</h1>
                        <p class="confirmation-message">Nous sommes ravis de vous compter parmi nous et nous vous tiendrons informé des détails de l'événement.</p>
                    @else
                        <div class="refuse-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                        <h1 class="confirmation-title">Réponse enregistrée</h1>
                        <p class="confirmation-message">Nous avons bien noté que vous ne pourrez pas être présent. Merci de nous avoir répondu.</p>
                    @endif
                    
                    <a href="{{ url('https://wadial-sa-beuss-front.vercel.app/acceuil') }}" class="return-button">Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>