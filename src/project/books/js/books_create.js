// 09-2: Games-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
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


//fix
// function isMinInteger(value, min) {
//     (!Number.isNaN(value)) && value >= min
// }

// function isMaxInteger(value, max) {
//     (!Number.isNaN(value)) && value >= max
// }

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};
    
    let titleMin = titleInput.dataset.minlength || 10;
    let titleMax = titleInput.dataset.maxlength || 255;
    let authorMin = authorInput.dataset.minlength || 10;
    let authorMax = authorInput.dataset.maxlength || 255;
    let yearMin = yearInput.dataset.mininteger|| 3;
    let yearMax = yearInput.dataset.maxinteger || 4;
    let isbnMin = yearInput.dataset.mininteger|| 13;
    let isbnMax = yearInput.dataset.maxinteger || 13;
    let descMin = 10;
    let descMax = 1000;

    //title
    if(!isRequired(titleInput.value)){
        addError('title', 'Title is required');
    } else if(!isMinLength(titleInput.value, titleMin)){
        addError('title', 'Title must be at least ' + titleMin + ' characters.');
    } else if(!isMaxLength(titleInput.value, titleMax)){
        addError('title', 'Title must be at most ' + titleMax + ' charcaters.');
    }

    //author
    if(!isRequired(authorInput.value)){
        addError('author', 'Author is required');
    } else if(!isMinLength(authorInput.value, authorMin)){
        addError('author', 'Author must be at least ' + authorMin + ' characters.');
    } else if(!isMaxLength(authorInput.value, authorMax)){
        addError('author', 'Author must be at most ' + authorMax + ' charcaters.');
    }

    //publisher
    if(!isRequired(publisherIdInput.value)){
        addError('publisher_id', 'Publisher is required');
    }

    //year
    if(!isRequired(yearInput.value)){
        addError('year', 'Year is required');
    } else if(!isMinInteger(yearInput.value, authorMin)){
        addError('year', 'Year must be at least ' + yearMin + ' integers.');
    } else if(!isMaxInteger(yearInput.value, authorMax)){
        addError('year', 'Year must be at most ' + yearMax + ' integers.');
    }

    //isbn
    if(!isRequired(isbnInput.value)){
        addError('isbn', 'Isbn is required');
    } else if(!isMinInteger(isbnInput.value, isbnMin)){
        addError('isbn', 'Isbn must be at least ' + isbnMin + ' integers.');
    } else if(!isMaxInteger(isbnInput.value, isbnMax)){
        addError('isbn', 'Isbn must be at most ' + isbnMax + ' integers.');
    }

    //format 
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
    } else if(!isMinLength(descriptionInput.value, descMin)){
        addError('description', `Description must be at least ${descMin} characters.`);
    } else if(!isMaxLength(descriptionInput.value, descMax)){
        addError('description', `Description must be at most ${descMax} characters.`);
    }

    // image
    if (!coverInput.files || coverInput.files.length === 0) {
        addError('cover', 'Book cover is required.');
    }

    showFieldErrors();
    showErrorSummaryTop();

    if(Object.keys(errors).length === 0){
        bookForm.submit();
        // alert('Form data Valid');
    }
}

