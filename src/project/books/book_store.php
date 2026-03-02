<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';


startSession();

try {
    $data = [];
    $errors = [];

    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [], 
        'description' => $_POST['description'] ?? null,
        'cover' => $_FILES['cover'] ?? null
    ];

    // Define validation rules
    $year = date("Y");
    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'publisher_id' => 'required|notempty|integer',
        'year' => 'required|notempty|integer|minvalue:1900|maxvalue:' . $year,
        'isbn' => 'required|notempty|min:13|max:13',
        'format_ids' => 'required|notempty|array|min:1|max:4',
        'description' => 'required|notempty|min:10|max:1000',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    // All validation passed - now process and save
    // Verify genre exists
    $publishers = Publisher::findById($data['publisher_id']);
    if (!$publishers) {
        throw new Exception('Selected publisher does not exist.');
    }

    // Process the uploaded image (validation already completed)
    $uploader = new ImageUpload();
    $cover_filename = $uploader->process($_FILES['cover']);

    if (!$cover_filename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Create new book instance
    $book = new Book();
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    $book->cover_filename = $cover_filename;

    // Save to database
    $book->save();
    // Create platform associations
    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            // Verify platform exists before creating relationship
            if (Format::findById($formatId)) {
                BookFormat::create($book->id, $formatId);
            }
        }
    }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Book stored successfully.');

    // Redirect to game details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if (isset($cover_filename) && $cover_filename) {
        $uploader->deleteImage($cover_filename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}
