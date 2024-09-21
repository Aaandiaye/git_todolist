<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taches;

class TachesController extends Controller
{
    // Affiche la liste des tâches avec des options de tri
    public function index()
    {
        // Récupérer le paramètre de tri de la requête, ou utiliser une chaîne vide par défaut
        $tri = request('tri', ''); 

        // Récupérer les tâches qui ne sont pas terminées ou qui ont été terminées il y a moins d'une heure
        $taches = Taches::where(function ($query) {
            $query->whereNull('completed_at') // Tâches non terminées
                  ->orWhere('completed_at', '>=', now()->subHour()); // Tâches terminées depuis moins d'une heure
        });

        // Appliquer le tri en fonction du paramètre reçu
        if ($tri === 'priorite') {
            $taches = $taches->orderByDesc('priorite'); // Trier par priorité
        } elseif ($tri === 'date_limite') {
            $taches = $taches->orderBy('date_limite'); // Trier par date limite
        }
       

        // Trier les tâches par statut (terminé ou non) et récupérer les résultats
        $taches = $taches->orderBy('termine')->get();  

        // Compter les tâches terminées et en attente
        $tachesTerminees = Taches::whereNotNull('completed_at')->count();
        $tachesEnAttente = Taches::whereNull('completed_at')->count();

        // Vérifier si toutes les tâches sont terminées
        $allTasksCompleted = Taches::whereNull('completed_at')->count() === 0;

        // Récupérer les tâches dont la date limite est dépassée ou proche
        $tachesEnRetard = $taches->filter(function ($tache) {
            return $tache->date_limite < now() && is_null($tache->completed_at);
        });

        // Récupérer les tâches dont la date limite est dans les 2 jours à venir
        $tachesProches = $taches->filter(function ($tache) {
            return $tache->date_limite >= now() && $tache->date_limite <= now()->addDays(2) && is_null($tache->completed_at);
        });

        // Passer les données à la vue
        return view('taches.index', [
            'taches' => $taches,
            'tachesTerminees' => $tachesTerminees,
            'tachesEnAttente' => $tachesEnAttente,
            'tri' => $tri,
            'allTasksCompleted' => $allTasksCompleted,
            'tachesEnRetard' => $tachesEnRetard,
            'tachesProches' => $tachesProches,
        ]);
    }

    // Affiche le formulaire de création d'une nouvelle tâche
    public function create()
    {
        return view('taches.create');
    }

    // Stocke une nouvelle tâche dans la base de données
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $data = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'nullable|string',
            'priorite' => 'required|integer',
            'date_limite' => 'nullable|date|after_or_equal:today',
        ],[
            'date_limite.after_or_equal' => 'La date limite ne peut pas être antérieure à la date actuelle.',
        ]);

        // Créer une nouvelle tâche avec les données validées
        $newTaches = Taches::create($data);

        // Rediriger vers la liste des tâches
        return redirect(route('taches.index'));
    }

    // Affiche le formulaire d'édition pour une tâche spécifique
    public function edit($id)
    {
        // Trouver la tâche par son ID ou lancer une exception si elle n'existe pas
        $tache = Taches::findOrFail($id);
        return view('taches.edit', compact('tache'));
    }

    // Met à jour les données d'une tâche existante
    public function update(Taches $tache, Request $request)
    {
        // Valider les données du formulaire
        $data = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'nullable|string',
            'priorite' => 'required|integer',
            'date_limite' => 'nullable|date|after_or_equal:today',
        ],[
            'date_limite.after_or_equal' => 'La date limite ne peut pas être antérieure à la date actuelle.',
        ]);

        // Mettre à jour les données de la tâche
        $tache->update($data);

        // Rediriger vers la liste des tâches avec un message de succès
        return redirect(route('taches.index'))->with('success','Mise à jour réussie !');
    }

    // Supprime une tâche spécifique
    public function destroy(Taches $tache)
    {
        // Supprimer la tâche
        $tache->delete();

        // Rediriger vers la liste des tâches avec un message de succès
        return redirect(route('taches.index'))->with('success','Suppression réussie !');
    }

    // Alterne le statut de complétion d'une tâche
    public function toggleCompleted(Taches $tache)
    {
        // Inverser le statut de la tâche (terminée ou non)
        $tache->termine = !$tache->termine;

        if ($tache->termine) {
            // Enregistre la date et l'heure de la complétion
            $tache->completed_at = now();
        } else {
            // Réinitialise la date de complétion si la tâche est réactivée
            $tache->completed_at = null;
        }

        // Sauvegarder les modifications
        $tache->save();

        // Rediriger vers la page précédente
        return redirect()->back();
    }

    // Affiche la liste des tâches terminées
    public function terminees()
    {
        // Récupérer les tâches terminées, triées par date de complétion
        $tachesTerminees = Taches::whereNotNull('completed_at')->orderBy('completed_at')->get();

        // Passer les tâches à la vue
        return view('taches.terminees', ['taches' => $tachesTerminees]);
    }

    // Affiche le formulaire de création d'une tâche avec une date pré-définie
    public function createWithDate($date = null)
    {
        return view('taches.create', ['date' => $date]);
    }

    // Affiche les détails d'une tâche spécifique
    public function show($id)
    {
        // Récupérer la tâche par son ID ou lancer une exception si elle n'existe pas
        $tache = Taches::findOrFail($id);

        // Retourner la vue avec les détails de la tâche
        return view('taches.show', compact('tache'));
    }
}



/*index() : Récupère et affiche la liste des tâches avec des options de tri, en comptant et filtrant les tâches en fonction de leur statut (terminée, en attente) et de leur échéance.
create() : Affiche le formulaire pour créer une nouvelle tâche.
store(Request $request) : Valide les données du formulaire de création, enregistre une nouvelle tâche dans la base de données, et redirige vers la liste des tâches.
edit($id) : Affiche le formulaire d'édition pour une tâche spécifique.
update(Taches $tache, Request $request) : Valide les données du formulaire d'édition, met à jour la tâche correspondante, et redirige vers la liste des tâches avec un message de succès.
destroy(Taches $tache) : Supprime une tâche spécifique et redirige vers la liste des tâches avec un message de succès.
toggleCompleted(Taches $tache) : Alterne le statut de complétion d'une tâche et enregistre la date de complétion ou réinitialise cette date si la tâche est réactivée.
terminees() : Affiche la liste des tâches terminées, triées par date de complétion.
createWithDate($date = null) : Affiche le formulaire de création d'une tâche avec une date pré-définie.
show($id) : Affiche les détails d'une tâche spécifique.*/