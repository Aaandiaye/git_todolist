<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - PLANIFY !</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
   
   
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PLANIFY !</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('taches.index') }}">Retour à la liste des tâches</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Title -->
    <div class="page-title">
    <h1 class="about-title">À propos de PLANIFY !</h1>
    <p class="about-subtitle">Découvrez l’histoire de notre application et comment elle peut vous aider à mieux organiser vos tâches.</p>
    </div>

    <!-- Introduction -->
    <div class="container mt-5 section-white">
        <h2>Introduction</h2>
        <p>PLANIFY! est une application de gestion de tâches conçue pour vous aider à organiser votre vie quotidienne. Que ce soit pour suivre vos projets professionnels ou vos tâches personnelles, PLANIFY vous offre une solution simple et efficace pour gérer vos priorités.</p>
    </div>

    <!-- Fonctionnalités Clés -->
    <div class="container section-blue">
        <h2>Fonctionnalités principales</h2>
        <ul>
            <li>Gestion des tâches : Créez, modifiez et supprimez des tâches facilement.</li>
            <li>Priorisation : Attribuez des niveaux de priorité à vos tâches pour mieux les organiser.</li>
            <li>Suivi des échéances : Ajoutez des dates limites et recevez des rappels pour ne jamais manquer une tâche importante.</li>
            <li>Marquage des tâches terminées : Cochez les tâches comme terminées une fois accomplies.</li>
        </ul>
    </div>

    <!-- Objectif et Philosophie -->
    <div class="container section-white">
        <h2>Notre mission</h2>
        <p>Notre mission est de simplifier la gestion des tâches pour permettre à chacun de se concentrer sur ce qui compte vraiment. Nous croyons qu'une bonne organisation est la clé du succès, et PLANIFY! a été conçu pour vous accompagner dans cette démarche.</p>
    </div>

    <!-- Historique du Projet -->
    <div class="container section-blue">
        <h2>L'histoire de PLANIFY!</h2>
        <p>PLANIFY a été créé dans le cadre d'un projet académique, avec pour objectif d'apprendre et de maîtriser les concepts fondamentaux du développement web, y compris les opérations CRUD, la validation des formulaires, et l'implémentation de l'authentification.</p>
    </div>

    <!-- L'équipe -->
    <div class="container section-white">
        <h2>L'équipe derrière PLANIFY!</h2>
        <p>PLANIFY! a été développé par Aissatou Kabir Ndiaye, étudiante avec un intérêt particulier pour les applications qui améliorent la productivité.</p>
    </div>

    <!-- Contact et Support -->
    <div class="container section-blue">
        <h2>Contactez-nous</h2>
        <p>Si vous avez des questions, des suggestions ou si vous rencontrez des problèmes avec l'application, n'hésitez pas à nous contacter à support@planify.com.</p>
    </div>

    <!-- Future Développements -->
    <div class="container section-white">
        <h2>Ce qui nous attend</h2>
        <p>Nous avons beaucoup d'idées concernant l'amélioration de PLANIFY! nous visons à ce qu'elle soit une application Top !!</p>
    </div>

    <!-- Remerciements -->
    <div class="container section-blue">
        <h2>Remerciements</h2>
        <p>Merci à tous ceux qui ont soutenu le développement de PLANIFY!</p>
    </div>

    <!-- Footer -->
    <!-- Footer complet pour la page À propos -->
<footer class="footer  ">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>À propos</h5>
                <p>PLANIFY ! est une application de gestion de tâches qui vous aide à organiser votre travail de manière efficace.</p>
            </div>
            <div class="col-md-4">
                <h5>Liens Utiles</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('apropos') }}" class="text-white">À propos</a></li>
                    <li><a href="{{ route('taches.index') }}" class="text-white">Tâches</a></li>
                    <li><a href="{{ route('taches.create') }}" class="text-white">Créer une tâche</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact</h5>
                <p>Email: <a href="mailto:support@planify.com" class="text-white">support@planify.com</a></p>
                <p>Téléphone: +221 33 800 00 00</p>
                <p>Adresse: Parcelles Assainies, Unité 08, Sénégal</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>&copy; 2024 PLANIFY! Tous droits réservés.</p>
        </div>
    </div>
</footer>


    <!-- Lien vers Bootstrap JS et ses dépendances -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
