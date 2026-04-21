<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];
    
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_POST['id'] ?? null,
        'publisher_name' => $_POST['publisher_name'] ?? null,

    ];

    // Define validation rules
    $rules = [
        'id' => 'required|notempty|min:1|max:255',
        'publisher_name' => 'required|notempty|min:10|max:255',
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // Verify publisher exists
    $publishers = Publisher::findById($data['id']);
    if (!$publishers) {
        throw new Exception('Selected publisher does not exist.');
    }
    
    $publishers->name = $data['publisher_name'];
    $publishers->save();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Publisher updated successfully.');

    // Redirect to game details page
    redirect('book_list.php');
}
catch (Exception $e) {
    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('book_list.php?id=' . $data['id']);
    }
    else {
        redirect('book_list.php');
    }
}
