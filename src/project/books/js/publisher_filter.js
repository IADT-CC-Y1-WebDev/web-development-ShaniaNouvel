let applyBtn = document.getElementById('apply_publisher');
let clearBtn = document.getElementById('clear_publisher');

let cardsContainer = document.getElementById("publisher_cards");

let cards = document.querySelectorAll('.pubCard');

let form = document.getElementById("filters_publisher");

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
        let pubA = a.dataset.publisher.toLowerCase();
        let pubB = b.dataset.publisher.toLowerCase();
        let yearA = Number(a.dataset.year);
        let yearB = Number(b.dataset.year);

        if (sortBy === "year_desc") return yearB - yearA;
        if (sortBy === "year_asc") return yearA - yearB;

        return pubA.localeCompare(pubB);
    });

    return list;
}

function cardMatches(crd, fltrs) {
    let publisher = crd.dataset.publisher.toLowerCase();

    let matchPublisher    = fltrs.publisherFilter    === "" || publisher.includes(fltrs.publisherFilter);

    return matchPublisher;
}

function getFilters() {
    const publisherEl = form.elements['publisher_filter'];
    // const sortEl = form.elements['sort_by'];

    let publisherFilter = (publisherEl.value || '').trim().toLowerCase();
    // let sortBy = sortEl.value || 'title_asc';

    return {
        "publisherFilter" : publisherFilter,
        // "sortBy" : sortBy
    };
}

function clearFilters() {
    form.reset();

    cards.forEach(card => {
        card.classList.remove('hidden');
    });

    let cardsArray = Array.from(cards);
    const sorted = sortCards(cardsArray, "title_asc");

    sorted.forEach(card => {
        cardsContainer.appendChild(card);
    });
}