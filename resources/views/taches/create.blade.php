<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Tâche</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="container mt-5">
        <h1>Créer une nouvelle tâche</h1>
        

        <!-- Formulaire de création de tâche -->
        <form action="{{route('taches.store')}}" method="POST">
            @csrf <!-- CSRF token pour la sécurité -->
            @method('POST')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de la Tâche</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom de la tâche" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Ajoutez une description (optionnel)"></textarea>
            </div>
            <div class="mb-3">
                <label for="priorite" class="form-label">Priorité</label>
                <select class="form-select" id="priorite" name="priorite">
                    <option value="1">Faible</option>
                    <option value="2">Moyenne</option>
                    <option value="3">Haute</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_limite" class="form-label">Date Limite</label>
                <input type="date" class="form-control" id="date_limite" name="date_limite" placeholder="Sélectionnez une date limite" value="{{ request('date') }}" >
            </div>
            <button type="submit" class="btn btn-secondary">Créer Tâche</button>
            <a href="{{ route('taches.index') }}" class="btn btn-secondary" id="cancel-btn">Annuler</a>
        </form>

    </div>

    <!-- Lien vers Bootstrap JS et Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>
