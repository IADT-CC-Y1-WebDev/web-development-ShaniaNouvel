// 09-2: Games-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let gameForm = document.getElementById('game_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let publisherIdInput = document.getElementById('publisher_id');
let descriptionInput = document.getElementById('description');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let formatIdsInput = document.getElementsByName('format_ids[]');
let coverInput = document.getElementById('cover');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let publisherIdError = document.getElementById('publisher_id_error');
let descriptionError = document.getElementById('description_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let formatIdsError = document.getElementById('format_ids_error');
let coverError= document.getElementById('cover_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }
    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError.innerHTML = errors.title || '';
    authorError.innerHTML = errors.author || '';
    publisherIdError.innerHTML = errors.publisher_id || '';
    descriptionError.innerHTML = errors.description || '';
    yearError.innerHTML = errors.year || '';
    isbnError.innerHTML = errors.isbn || '';
    formatIdsError.innerHTML = errors.format_ids || '';
    coverError.innerHTML = errors.cover || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};
    
    let titleMin = titleInput.dataset.minlength || 3;
    let titleMax = titleInput.dataset.maxlength || 255;
    let descMin = 10;
    let descMax = 255;

    //title
    if(!isRequired(titleInput.value)){
        addError('title', 'Title is required');
    } else if(!isMinLength(titleInput.value, titleMin)){
        addError('title', 'Title must be at least ' + titleMin + ' characters.');
    } else if(!isMaxLength(titleInput.value, titleMax)){
        addError('title', 'Title must be at most ' + titleMax + ' charcaters.');
    }

    //release date
    if(!isRequired(authorInput.value)){
        addError('author_date', 'Author is required');
    }

    if(!isRequired(publisherIdInput.value)){
        addError('publisher_id', 'Publisher is required');
    }

    if(!isRequired(yearInput.value)){
        addError('year', 'Year is required');
    }

    if(!isRequired(isbnInput.value)){
        addError('isbn', 'Isbn is required');
    }

    //platform 
    let formatSelected = false;
    for (let i = 0; i < formatIdsInput.length; i++) {
        if (formatIdsInput[i].checked) {
            formatSelected = true;
            break;
        }
    }

    if (!formatSelected) {
        addError('format_ids', 'Select at least one Format.');
    }

    //description
    if(!isRequired(descriptionInput.value)){
        addError('description', 'Description is required');
    } else if(!isMinLength(titleInput.value, descMin)){
        addError('Description', `Description must be at least ${descMin} characters.`);
    } else if(!isMaxLength(titleInput.value, descMax)){
        addError('Description', `Description must be at least ${descMax} characters.`);
    }

    // image
    if (!coverInput.files || coverInput.files.length === 0) {
        addError('cover', 'Book cover is required.');
    }

    showFieldErrors();
    showErrorSummaryTop();

    if(Object.keys(errors).length === 0){
        //gameForm.submit();
        alert('Form data Valid');
    }
}

