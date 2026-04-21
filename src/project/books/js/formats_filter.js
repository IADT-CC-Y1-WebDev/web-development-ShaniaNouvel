function formatFilters() {
    let applyBtn = document.getElementById('apply_format');
    let clearBtn = document.getElementById('clear_format');

    let cardsContainer = document.getElementById("format_cards");

    let cards = document.querySelectorAll('.formCard');

    let form = document.getElementById("filters_format");

    applyBtn.addEventListener('click', (event) => {
        event.preventDefault();
        applyFilters();
    });

    clearBtn.addEventListener('click', (event) => {
        event.preventDefault();
        clearFilters();
    });

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        applyFilters();
    });

    function applyFilters() {
        let filters = getFilters();

        for (let i = 0; i != cards.length; i++) {
            let card = cards[i];
            let match = cardMatches(card, filters);
            card.classList.toggle('hidden', !match);
        }
        let cardsArray = Array.from(cards);
        const sorted = sortCards(cardsArray, filters.sortBy);
        sorted.forEach(card => {
            cardsContainer.appendChild(card);
        });
    }

    function sortCards(cards, sortBy) {
        const list = cards.slice();
        
        list.sort((a, b) => {
            let formA = a.dataset.format.toLowerCase();
            let formB = b.dataset.format.toLowerCase();
            let idA = Number(a.dataset.id);
            let idB = Number(b.dataset.id);

            if (sortBy === "formId_desc") return idB - idA;
            if (sortBy === "formId_asc") return idA - idB;

            return formA.localeCompare(formB);
        });

        return list;
    }

    function cardMatches(crd, fltrs) {
        let format = crd.dataset.format.toLowerCase();

        let matchFormat   = fltrs.formatFilter    === "" || format.includes(fltrs.formatFilter);

        return matchFormat;
    }

    function getFilters() {
        const formatEl = form.elements['format_filter'];
        const sortEl = form.elements['sort_by'];

        let formatFilter = (formatEl.value || '').trim().toLowerCase();
        let sortBy = sortEl.value || 'form_asc';

        return {
            "formatFilter" : formatFilter,
            "sortBy" : sortBy
        };
    }

    function clearFilters() {
        form.reset();

        cards.forEach(card => {
            card.classList.remove('hidden');
        });

        let cardsArray = Array.from(cards);
        const sorted = sortCards(cardsArray, "form_asc");

        sorted.forEach(card => {
            cardsContainer.appendChild(card);
        });
    }
}

formatFilters();