document.addEventListener('DOMContentLoaded', () => {
    // === 1. INITIALISATION DE LA CARTE ===
    const thiesBounds = [
        [14.4, -17.2],
        [17.2, -16.4]
    ];

    const map = L.map('map', {
        center: [14.79, -16.92],
        zoom: 10,
        minZoom: 9,
        maxZoom: 18,
        maxBounds: thiesBounds,
        maxBoundsViscosity: 1.0,
        scrollWheelZoom: false,
        boxZoom: false
    });

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CartoDB',
        maxZoom: 15
    }).addTo(map);

    // === 2. ICÔNE UNIQUE POUR TOUS LES TÉMOIGNAGES ===
    const iconTemoignage = L.icon({
        iconUrl: 'images/temoin.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -25]
    });

    // === 3. DONNÉES DES TÉMOIGNAGES ===
    const temoignages = [
        { nom: "Alassane Fall", region: "Mbour", lat: 14.4497, lng: -16.9667, message: "Kits scolaire" },
        { nom: "Mor Ndiaye", region: "Tivaouane", lat: 14.7667, lng: -16.9167, message: "Don de sang" },
        { nom: "Sidi Beye", region: "Pout", lat: 14.77099, lng: -17.06028, message: "Ndogou" },
        { nom: "Adama Faye", region: "Fandène", lat: 14.8415, lng: -16.9064, message: "Consultation gratuite" },
        { nom: "Astou Gueye", region: "Bambilor", lat: 14.7769, lng: -17.1617, message: "Kits alimentaires" },
        { nom: "Anna Sow", region: "Sindia", lat: 14.4970, lng: -17.0639, message: "Soutien scolaire" },
        { nom: "Khady Lam", region: "Tassette", lat: 14.6464, lng: -16.9733, message: "Hygiène & santé" },
        { nom: "Gora Fame", region: "Ndiaganiao", lat: 14.5333, lng: -16.6833, message: "Médicaments essentiels" }
    ];

    const markers = temoignages.map(t => {
        return L.marker([t.lat, t.lng], { icon: iconTemoignage })
            .bindTooltip(
                `<strong>${t.nom}</strong><br><em>${t.region}</em><br>${t.message}`,
                {
                    permanent: false,
                    direction: 'top',
                    offset: [0, -10],
                    opacity: 0.9,
                    className: 'leaflet-tooltip-custom'
                }
            )
            .addTo(map);
    });

    // === 4. ZONES CIBLÉES ===
    const zonesCiblees = [
        { nom: "Fissel", coords: [14.65, -17.00] },
        { nom: "Khombol", coords: [14.70, -16.95] },
        { nom: "Ndagalma", coords: [14.60, -16.90] },
        { nom: "Refane", coords: [14.55, -16.85] },
        { nom: "Diohine", coords: [14.50, -16.80] },
        { nom: "Kayar", coords: [14.9172, -17.1194] },
        { nom: "Thiénaba", coords: [14.7833, -16.8833] },
        { nom: "Thiadiaye", coords: [14.4167, -16.6833] }
    ];

    zonesCiblees.forEach(zone => {
        L.circle(zone.coords, {
            color: '#228B22',
            fillColor: '#90ee90',
            fillOpacity: 0.3,
            radius: 3000
        })
        .bindTooltip(`Zone ciblée : ${zone.nom}`, {
            direction: 'top',
            opacity: 0.8
        })
        .addTo(map);
    });

    // === 5. AJUSTEMENT DE LA VUE APRÈS CHARGEMENT ===
    const group = L.featureGroup(markers);
    setTimeout(() => {
        map.fitBounds(group.getBounds().pad(0.2));
    }, 300);

    // === 6. AJOUT DE L'ÉCHELLE ===
    L.control.scale().addTo(map);

    // === 7. ANIMATION DES CARTES TÉMOINS ===
    const cards = document.querySelectorAll('.rim');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('appear');
        }, index * 200);
    });

    // === 8. POPUP AU CLIC SUR UNE CARTE ===
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const name = card.querySelector('.client-name')?.innerText || '';
            const message = card.querySelector('.testimonial-text')?.innerText || '';
            showPopup(name, message);
        });
    });

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
        popup.querySelector('button').addEventListener('click', () => popup.remove());
    }

    // === 9. COMPTEURS STATISTIQUES ===
    const counters = document.querySelectorAll('.stat-number');

    const animateCount = (el) => {
        const target = +el.getAttribute('data-target');
        const speed = 200;
        const increment = target / speed;
        let count = 0;

        const update = () => {
            if (count < target) {
                count += increment;
                el.textContent = '+' + Math.ceil(count);
                requestAnimationFrame(update);
            } else {
                el.textContent = '+' + target;
            }
        };
        update();
    };

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCount(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.6 });

    counters.forEach(counter => observer.observe(counter));

    // === 10. MENU MOBILE ===
    const toggleMenu = () => {
        const menu = document.getElementById("menu");
        menu.classList.toggle("active");
    };

    document.querySelectorAll('.menu').forEach(link => {
        link.addEventListener('click', () => {
            document.getElementById("menu").classList.remove("active");
        });
    });

    document.addEventListener('click', (e) => {
        const menu = document.getElementById("menu");
        const toggle = document.querySelector(".menu-toggle");
        if (!menu.contains(e.target) && !toggle.contains(e.target)) {
            menu.classList.remove("active");
        }
    });
});
