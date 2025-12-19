document.addEventListener('DOMContentLoaded', () => {
    const eventsContainer = document.getElementById('events-container');

    if (eventsContainer) {
        fetch('data/events.json')
            .then(response => response.json())
            .then(data => {
                renderEvents(data);
            })
            .catch(error => {
                console.error('Erreur chargement events:', error);
                eventsContainer.innerHTML = '<p style="text-align:center; color:red;">Erreur lors du chargement du planning.</p>';
            });
    }

    function renderEvents(events) {
        if (!events || events.length === 0) {
            eventsContainer.innerHTML = '<p style="text-align:center;">Aucun événement à venir.</p>';
            return;
        }

        // Sort events by date just in case
        events.sort((a, b) => new Date(a.date) - new Date(b.date));

        // Filter out past events
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const upcomingEvents = events.filter(event => {
            return new Date(event.date) >= today;
        });

        if (upcomingEvents.length === 0) {
            eventsContainer.innerHTML = '<p style="text-align:center;">Aucun événement à venir pour le moment.</p>';
            return;
        }

        let html = '';
        upcomingEvents.forEach(event => {
            const dateObj = new Date(event.date);
            const day = dateObj.getDate();
            const month = dateObj.toLocaleString('fr-FR', { month: 'short' });
            const year = dateObj.getFullYear();
            const weekday = dateObj.toLocaleString('fr-FR', { weekday: 'long' });

            html += `
                <article class="event-card">
                    ${event.complet ? '<div class="event-status">COMPLET</div>' : ''}
                    <div class="event-date-badge">
                        <span class="day">${day}</span>
                        <span class="month">${month}</span>
                    </div>
                    <div class="event-details">
                        <h3 class="event-title">${event.titre}</h3>
                        <div class="event-info">
                            <span>🕒</span> ${event.heure}
                        </div>
                        <div class="event-info">
                            <span>📍</span> ${event.lieu}
                        </div>
                        <div class="event-price">
                            ${event.prix}
                        </div>
                        ${event.description ? `<p style="font-size:0.85rem; margin-top:10px; font-style:italic;">${event.description}</p>` : ''}
                    </div>
                </article>
            `;
        });

        eventsContainer.innerHTML = html;
    }
});
