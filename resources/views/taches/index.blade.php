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
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
                    <a class="nav-link" href="{{ route('apropos') }}">À propos</a>
                </li>

                <!-- Liens d'authentification -->
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

    

    <!-- Contenu de la page -->
    <div class="container mt-5">
        <h1 class="planify-title">Bienvenue sur PLANIFY !</h1>
        <p class="planify-subtitle">Organisez vos tâches efficacement avec notre application de to-do list.</p>
        
        <!-- Filtre de tri -->
        <div class="d-flex justify-content-between align-items-center my-5">
            <div>
                <a href="{{ route('taches.index', ['tri' => 'priorite']) }}" class="btn btn-secondary">Trier par Priorité</a>
                <a href="{{ route('taches.index', ['tri' => 'date_limite']) }}" class="btn btn-secondary">Trier par Date Limite</a>
            </div>
            <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#calendarModal">
                Afficher le Calendrier
            </button>
        </div>

    <!-- Modal pour afficher le calendrier -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Calendrier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="calendar"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

        

        <!-- Affichage des statistiques -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="alert alert-success" role="alert">
                    Nombre de tâches terminées : {{ $tachesTerminees }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-warning" role="alert">
                    Nombre de tâches en attente : {{ $tachesEnAttente }}
                </div>
            </div>
        </div>
        
<!-- Affichage des alertes -->
@if($tachesEnRetard->isNotEmpty())
    <div class="alert alert-danger">
        Attention ! Vous avez des tâches dont la date limite est dépassée :
        <ul>
            @foreach($tachesEnRetard as $tacheRetard)
                <li>{{ $tacheRetard->nom }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($tachesProches->isNotEmpty())
    <div class="alert alert-warning">
        Attention ! Vous avez des tâches avec des dates limites proches :
        <ul>
            @foreach($tachesProches as $tacheProche)
                <li>{{ $tacheProche->nom }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($tachesEnAttente == 0)
    <div class="alert alert-success">
        Félicitations ! Vous avez complété toutes vos tâches !
    </div>
@endif



<div class="d-flex justify-content-between align-items-center my-5">
    <a href="{{ route('taches.create') }}" class="btn btn-secondary btn-lg btn-custom">
        <i class="fas fa-plus-circle"></i> Créer/Ajouter une tâche
    </a>
</div>
        
        <table class="table table-striped table-custom">
    <thead>
        <tr>
            <th>Terminé</th>
            <th>Titre</th>
            {{--<th>Description</th>--}}
            <th>Priorité</th>
            {{--<th>Date limite</th>--}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="task-list">
        @foreach($taches as $tache)
        <tr style="text-decoration: {{ $tache->termine ? 'line-through' : 'none' }};" 
            class="task-row" data-priority="{{ $tache->priorite }}">
            <td>
                <form action="{{ route('tache.toggle', $tache->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" 
                           onclick="this.form.submit()" 
                           {{ $tache->termine ? 'checked' : '' }}>
                </form>
            </td>
            <td>{{ $tache->nom }}</td>
            {{--<td>{{ $tache->description }}</td>--}}
            <td class="priority-cell">
                {{ $tache->priorite == 1 ? 'Faible' : ($tache->priorite == 2 ? 'Moyenne' : 'Élevée') }}
            </td>
            {{--<td>{{ $tache->date_limite }}</td>--}}
            <td>
            <a href="{{ route('taches.edit', ['tache' => $tache->id]) }}" class="btn btn-success">
        <i class="fas fa-edit"></i> Éditer
    </a>
                <form action="{{ route('taches.destroy', ['tache' => $tache->id]) }}" method="POST" class="d-inline">
                @csrf
        @method('delete')
        <button class="btn btn-danger">
            <i class="fas fa-trash-alt"></i> Supprimer
        </button>
                </form>
                <a href="{{ route('taches.show', $tache->id) }}" class="btn btn-primary">Voir</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


        <!-- Bouton pour les tâches terminées -->
<div class="d-flex justify-content-between align-items-center my-5">
<a href="{{ route('taches.terminees') }}" class="btn btn-secondary btn-lg btn-custom">
        <i class="fas fa-check-circle"></i> Voir les tâches terminées
    </a>
</div>


        <div>
            @if (session()->has('success'))
            <div>
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>

   

    <!-- Lien vers Bootstrap JS et Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ mix('js/app.js') }}"></script> <!-- S'assurer que le fichier app.js soit chargé -->
    

</body>

<!-- Footer simplifié pour la page d'accueil -->
<footer class="footer text-center ">
    <p>&copy; 2024 PLANIFY! Tous droits réservés.</p>
</footer>



</html>
