<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        @keyframes fadeInAnimation {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        body { try
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

        #part2 {
            animation: fadeInAnimation ease 1s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            opacity: 1; /* Assure que l'élément est visible par défaut */
        }

        #part1.hidden, #part2.hidden {
            display: none;
        }

    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card" style="width: 400px;">
        <div class="card-body">
                <?php if(isset($message)): ?>
                    <div class="alert alert-danger"><?php echo $message; ?></div>
                <?php endif; ?>
            
            <form method="POST" action="Controleur/controleur.php?action=lg">
                <div id="part1">
                    <h1 class="card-title text-center">Vos informations</h1>
                    <div class="form-group">
                        <label for="username">Nom</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="password">Prénom</label>
                        <input type="text" class="form-control" id="surname" name="surname">
                    </div>
                    <div class="form-group">
                        <label for="profession">profession</label>
                        <input type="text" class="form-control" id="job" name="job">
                    </div>
                    <button type="button" class="btn btn-primary btn-block" onclick="next_part()">Suivant</button>
                </div>
                <div id="part2" class="hidden">
                    <h1 class="card-title text-center">Créer un compte</h1>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Valider</button>
                </div>    
            </form>
        </div>
    </div>
</div>
<script>
    function next_part() {
        var part1 = document.getElementById("part1");
        var part2 = document.getElementById("part2");

        // Ajoute la classe hidden pour masquer part1
        part1.classList.add("hidden");

        // Supprime la classe hidden pour afficher part2
        part2.classList.remove("hidden");
    }
</script>
</body>
</html>
