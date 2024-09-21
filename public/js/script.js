// Lorsque le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', function () {
    // Récupère l'élément <select> pour les priorités
    var selectPriorite = document.getElementById('priorite');
    
    // Vérifie si l'élément est bien trouvé
    console.log(selectPriorite);

    // Applique une couleur en fonction de la priorité sélectionnée
    selectPriorite.addEventListener('change', function () {
        var selectedOption = selectPriorite.options[selectPriorite.selectedIndex];
        console.log(selectedOption.value); // Affiche la valeur sélectionnée

        // Change la couleur de fond et du texte selon la priorité
        if (selectedOption.value === '1') {
            selectPriorite.style.backgroundColor = '#808080'; // Couleur pour faible priorité
            selectPriorite.style.color = '#fff'; // Couleur du texte
        } else if (selectedOption.value === '2') {
            selectPriorite.style.backgroundColor = '#ffD700'; // Couleur pour priorité moyenne
            selectPriorite.style.color = '#fff'; // Couleur du texte
        } else if (selectedOption.value === '3') {
            selectPriorite.style.backgroundColor = '#ff0000'; // Couleur pour haute priorité
            selectPriorite.style.color = '#fff'; // Couleur du texte
        }
    });

    // Applique la couleur initiale en fonction de la sélection par défaut
    var selectedOption = selectPriorite.options[selectPriorite.selectedIndex];
    if (selectedOption.value === '1') {
        selectPriorite.style.backgroundColor = '#808080';
        selectPriorite.style.color = '#fff';
    } else if (selectedOption.value === '2') {
        selectPriorite.style.backgroundColor = '#ffD700';
        selectPriorite.style.color = '#fff';
    } else if (selectedOption.value === '3') {
        selectPriorite.style.backgroundColor = '#ff0000';
        selectPriorite.style.color = '#fff';
    }
});

// Lorsque le DOM est complètement chargé
document.addEventListener("DOMContentLoaded", function() {
    // Récupère la date actuelle au format YYYY-MM-DD
    var today = new Date().toISOString().split('T')[0]; 
    // Définit l'attribut 'min' de l'élément <input> pour les dates afin qu'il ne puisse pas être antérieur à aujourd'hui
    document.getElementById('date_limite').setAttribute('min', today);

    // Ajoute un écouteur d'événements pour la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(event) {
        var selectedDate = document.getElementById('date_limite').value;
        var errorMessage = document.getElementById('error-message');

        // Vérifie si la date limite est antérieure à aujourd'hui
        if (selectedDate < today) {
            // Affiche un message d'erreur
            errorMessage.textContent = 'La date limite ne peut pas être antérieure à la date actuelle.';
            event.preventDefault(); // Empêche la soumission du formulaire
        } else {
            // Efface le message d'erreur si la date est valide
            errorMessage.textContent = '';
        }
    });
});

// Lorsque le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    // Récupère l'élément du calendrier par son ID
    var calendarEl = document.getElementById('calendar');
    // Initialise un nouveau calendrier FullCalendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth', // Vue initiale du calendrier
        headerToolbar: {
            left: 'prev,next today', // Boutons de navigation et bouton 'aujourd'hui'
            center: 'title', // Affiche le titre du calendrier
            right: 'dayGridMonth,timeGridWeek,timeGridDay' // Options de vue (mois, semaine, jour)
        },
        // Gestion des clics sur les dates
        dateClick: function(info) {
            var selectedDate = info.dateStr;
            // Redirige vers le formulaire de création de tâche avec la date sélectionnée
            window.location.href = "/taches/create?date=" + selectedDate; 
        }
    });
    // Affiche le calendrier
    calendar.render();
});

// Lorsque le DOM est complètement chargé
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne toutes les lignes de tâches dans le tableau
    const taskRows = document.querySelectorAll('.task-row');

    // Itère sur chaque ligne de tâche pour ajouter des marques en fonction de la priorité
    taskRows.forEach(row => {
        // Récupère la valeur de priorité depuis un attribut de données
        const priority = row.getAttribute('data-priority');

        // Ajoute une marque en fonction de la priorité
        if (priority == '3') { // Priorité élevée
            row.querySelector('.priority-cell').innerHTML += ' ⭐'; // Étoile pour une priorité élevée
        } else if (priority == '2') { // Priorité moyenne
            row.querySelector('.priority-cell').innerHTML += ' •'; // Point pour une priorité moyenne
        }
        // Priorité faible (1) n'aura aucune marque ajoutée
    });
});





/*Gestion des priorités : Modifie la couleur du fond et du texte d'un <select> en fonction de la priorité sélectionnée.
Validation de date : Assure que la date limite ne peut pas être antérieure à aujourd'hui et affiche un message d'erreur en cas de problème.
Calendrier FullCalendar : Initialise et configure un calendrier interactif, avec redirection vers la page de création de tâche en cas de clic sur une date.
Marques de priorité : Ajoute des symboles visuels dans les lignes du tableau en fonction de la priorité des tâches.*/