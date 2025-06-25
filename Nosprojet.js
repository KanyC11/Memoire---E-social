
 src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
document.addEventListener('DOMContentLoaded', () => {
    // Limites géographiques pour la région de Thiès (approximatives)
    const thiesBounds = [
        [14.4, -17.2],  // coin sud-ouest (lat, lng)
        [15.2, -16.4]   // coin nord-est (lat, lng)
    ];

    // Initialisation de la carte centrée sur la région de Thiès avec limites
    const map = L.map('map', {
        center: [14.79, -16.92],
        zoom: 10,
        maxBounds: thiesBounds,
        maxBoundsViscosity: 1.0,
        dragging: true,
        scrollWheelZoom: true,
        doubleClickZoom: true,
        boxZoom: true,
        keyboard: true,
        touchZoom: true
    });

    // Ajout de la couche OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Définition des icônes personnalisées
    const iconFormation = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png', // icône utilisateur
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -30]
    });

    const iconEducation = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/1077/1077012.png', // icône livre
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -30]
    });

    const iconEau = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/7281/7281763.png', // Goutte d’eau
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -30]
    });

    // Liste des témoignages avec coordonnées et icônes
    const temoignages = [
        {
            nom: "Mamadou Fall",
            region: "Thiès",
            lat: 14.79,
            lng: -16.92,
            message: "Formation professionnelle",
            icon: iconFormation
        },
        {
            nom: "Fatou Sow",
            region: "Mbour",
            lat: 14.4497,
            lng: -16.9667,
            message: "Éducation des enfants",
            icon: iconEducation
        },
        {
            nom: "Ibrahima Diop",
            region: "Tivaouane",
            lat: 14.7667,
            lng: -16.9167,
            message: "Éducation des enfants",
            icon: iconEducation
        },
        {
            nom: "Aïssatou Ba",
            region: "Pout",
            lat: 14.77099,
            lng: -17.06028,
            message: "Accès à l’eau potable",
            icon: iconEau
        }
    ];

    // Ajout des marqueurs sur la carte avec icônes et popups
    temoignages.forEach(t => {
        L.marker([t.lat, t.lng], { icon: t.icon })
            .addTo(map)
            .bindPopup(`<strong>${t.nom}</strong><br><em>${t.region}</em><br>${t.message}`);
    });

    // Ajout de l'échelle
    L.control.scale().addTo(map);

    // Ajustement de la vue pour afficher tous les marqueurs (limité à la région)
    const group = L.featureGroup(temoignages.map(t => L.marker([t.lat, t.lng])));
    map.fitBounds(group.getBounds().pad(0.2));
});


//temoignage

document.addEventListener('DOMContentLoaded', () => {
    // Animation d'apparition
    const cards = document.querySelectorAll('.rim');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('appear');
        }, index * 300); // délai progressif
    });

    // Popup personnalisé au clic
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const name = card.querySelector('.client-name').innerText;
            const message = card.querySelector('.testimonial-text').innerText;

            showPopup(name, message);
        });
    });

    // Fonction de popup stylée
    function showPopup(title, text) {
        const popup = document.createElement('div');
        popup.className = 'custom-popup';
        popup.innerHTML = `
            <div class="popup-content">
                <h4>${title}</h4>
                <p>${text}</p>
                <button class="btn btn-warning mt-2">Fermer</button>
            </div>
        `;
        document.body.appendChild(popup);

        popup.querySelector('button').addEventListener('click', () => {
            popup.remove();
        });
    }
});







document.addEventListener('DOMContentLoaded', () => {
    // Initialisation de la carte centrée sur le Sénégal
    const map = L.map('map').setView([14.6928, -17.4467], 8);

    // Ajout de la couche de fond OpenStreetMap (gratuite)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    }).addTo(map);

    // Liste des témoignages avec coordonnées
    const temoignages = [
        {
            nom: "Mamadou Fall",
            region: "Thies",
            lat: 14.6928,
            lng: -17.4467,
            message: "Formation professionnelle"
        },
        {
            nom: "Fatou Sow",
            region: "Mbour",
            lat: 14.7167,
            lng: -17.2667,
            message: "Éducation des enfants"
        }
        // ➕ Tu peux ajouter d'autres bénéficiaires ici
    ];

    // Ajout des marqueurs sur la carte
    temoignages.forEach(t => {
        L.marker([t.lat, t.lng])
            .addTo(map)
            .bindPopup(`<strong>${t.nom}</strong><br>${t.region}<br>${t.message}`);
    });
});

