<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLANIFY !</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
    <!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PLANIFY !</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a href="{{ route('taches.index') }}" class="nav-link">Retour à la liste des tâches</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<div class="container">
        <h1>Détails de la tâche</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>TITRE :</strong> {{ $tache->nom }}</h5>
                <p class="card-text"><strong>Description :</strong> {{ $tache->description }}</p>
                <p><strong>Priorité :</strong> {{ $tache->priorite }}</p>
                <p><strong>Date limite :</strong> {{ \Carbon\Carbon::parse($tache->date_limite)->format('d/m/Y') }}</p>
                <p><strong>Statut :</strong> {{ $tache->termine ? 'Terminée' : 'En cours' }}</p>
                
            </div>
        </div>
    </div>













     <!-- Lien vers Bootstrap JS et Popper.js -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script> <!-- S'assurer que le fichier app.js soit chargé -->
</body>