<?php

use Core\App;

$db = App::resolve(\Core\Database::class);

$CurrentUser = 1;

$note = $db->query('select * from notes where id = :id', [':id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] === $CurrentUser);

$note = $db->query('Delete from notes where id = :id', [':id' => $_POST['id']]);

header("Location: \\notes");
exit();
