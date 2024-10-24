<?php

use Core\App;

$db = App::resolve(\Core\Database::class);

$id = $_GET['id'];
$CurrentUser = 1;


$note = $db->query('select * from notes where id = :id', [':id' => $id])->findOrFail();

authorize($note['user_id'] === $CurrentUser);

view("notes\\edit.view.php", [
    'heading' => 'Edit note',
    'errors' => [],
    'note' => $note,
]);