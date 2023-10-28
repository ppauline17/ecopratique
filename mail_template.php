<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>HTML template email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        .template {
            background-color: #3A4A40;
            padding: 20px;
        }

        .infos {
            background-color: white;
            padding: 20px;
            border-radius: 20px;
        }
        .btn-green{
            background-color: #edf7f1;
            border: #edf7f1;
            color: #3A4A40;
        }
        .btn-green:hover{
            background-color: #3A4A40;
            border: #3A4A40;
            color: #edf7f1 !important;
        }
    </style>
</head>

<body class="template">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="infos p-5">
                    <h1 class="text-center mb-3">Eco pratique</h1>
                    <p class="text-center">Bonjour <?=$firstname?>,</p>
                    <p class="text-center">Vous avez oublié votre mot de passe ?</p>
                    <p class="text-center">Cliquez sur ce bouton pour choisir un nouveau mot de passe</p>
                    <div class="row">
                        <a href="https://pauline-pasquier-dev.fr/ecopratique/reinitialiser/<?=$user_id?>/<?=$token?>" class="col-6 offset-3"><button class="btn btn-green w-100">Réinitialiser mon mot de passe</button></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>