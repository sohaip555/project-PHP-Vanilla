<?php

use Core\App;
use Core\Validator;

$db = App::resolve(\Core\Database::class);

$id = $_POST['id'];
$CurrentUser = 1;


$note = $db->query('select * from notes where id = :id', [':id' => $id])->findOrFail();

authorize($note['user_id'] === $CurrentUser);

$errors = [];


if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}


if (count($errors)) {
    view("notes\\edit.view.php", [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note,
    ]);
}


$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

// redirect the user
header('location: /notes');
die();
