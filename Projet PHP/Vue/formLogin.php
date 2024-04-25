<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to bottom right, #000000, #113a66); /* Fond en gradient noir à bleu foncé */
            color: white; /* Texte en blanc pour contraste */
        }

        .card {
            background: rgba(142, 142, 142, 0.19);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            color: white;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.1); /* Fond semi-transparent pour les champs de formulaire */
            border: 1px solid rgba(255, 255, 255, 0.1); /* Bordure semi-transparente */
            color: white; /* Texte en blanc pour contraste */
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.2); /* Légère couleur de fond lorsqu'un champ est focus */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure légèrement plus visible */
            color: white;
        }

        .btn-primary {
            background-color: #007bff; /* Couleur bleue primaire pour le bouton */
            border-color: #007bff; /* Bordure bleue primaire */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Couleur bleue légèrement plus foncée au survol */
            border-color: #0056b3; /* Bordure légèrement plus foncée au survol */
        }

    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 400px;">
        <div class="card-body">
            <h1 class="card-title text-center">Login</h1>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
            
            <form method="POST" action="index.php?action=LG">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
