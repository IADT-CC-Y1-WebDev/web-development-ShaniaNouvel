let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');

let cards = document.querySelector("filters");

let form = document.getElementById("filters");

applyBtn.addEventListener('click', (event) => {
    event.preventDefault();
    applyFilters();
});
clearBtn.addEventListener('click', (event) => {
    event.preventDefault();
    clearFilters();
});

function applyFilters() {
    // console.log("Applying filters");
    let filters = getFilters();
    let matches = [];
    for (let i = 0; i != cards.length; i++){
        let card = cards[i];
        matches[i] = cardMatches(card, filters);
    }
    console.log(matches);
}


function cardMatches(crd, fltrs) {
    // console.log(crd.dataset.title, fltrs.titleFilter);
    let title = crd.dataset.title.toLowerCase();
    return title.includes(fltrs.titleFilter);
}

function getFilters() {
    const titleE1 = form.elements['title_filter'];
    const genreE1 = form.elements['genre_filter'];
    const platformE1 = form.elements['platform_filter'];
    const sortE1 = form.elements['sort_by'];

    let titleFilter = (titleE1.value || '').trim().toLowerCase();
    let genreFilter = genreE1.value || '';
    let platformFilter = platformE1.value || '';
    let sortBy = sortE1.value || 'title_asc';

    return {
        "titleFilter" : titleFilter,
        "genreFilter" : genreFilter,
        "platformFilter" : platformFilter,
        "sortBy" : sortBy
    }
}

function clearFilters() {
    console.log("Clearing filters");
}
