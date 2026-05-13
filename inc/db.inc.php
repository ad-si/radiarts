<?php

$db = new PDO('sqlite:' . __DIR__ . '/../dbs/index.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$table_exists = (bool) $db->query(
    "SELECT name FROM sqlite_master WHERE type='table' AND name='radiartworks'"
)->fetchColumn();

$db->exec('CREATE TABLE IF NOT EXISTS radiartworks (
    id integer PRIMARY KEY,
    user text,
    title text,
    array text,
    x integer,
    y integer,
    time text,
    up integer,
    down integer
)');

if (!$table_exists) {
    seed_example_artworks($db);
}

function seed_example_artworks($db) {
    $examples = [
        [
            'user'   => 'Adrian',
            'title'  => 'Plus',
            'x'      => 3,
            'y'      => 3,
            'pixels' => [2, 4, 5, 6, 8],
        ],
        [
            'user'   => 'Adrian',
            'title'  => 'Heart',
            'x'      => 7,
            'y'      => 6,
            'pixels' => [
                2, 3, 5, 6,
                8, 9, 10, 11, 12, 13, 14,
                15, 16, 17, 18, 19, 20, 21,
                23, 24, 25, 26, 27,
                31, 32, 33,
                39,
            ],
        ],
        [
            'user'   => 'Adrian',
            'title'  => 'Smiley',
            'x'      => 8,
            'y'      => 8,
            'pixels' => [
                3, 4, 5, 6,
                10, 15,
                17, 19, 22, 24,
                25, 32,
                33, 35, 38, 40,
                41, 44, 45, 48,
                50, 55,
                59, 60, 61, 62,
            ],
        ],
    ];

    $insert = $db->prepare(
        "INSERT INTO radiartworks " .
        "(id, user, title, array, x, y, time, up, down) " .
        "VALUES (NULL, :user, :title, :array, :x, :y, datetime('now'), 0, 0)"
    );

    foreach ($examples as $artwork) {
        $img = [];
        foreach ($artwork['pixels'] as $cell) {
            $img[$cell] = 1;
        }
        $insert->execute([
            ':user'  => $artwork['user'],
            ':title' => $artwork['title'],
            ':array' => serialize($img),
            ':x'     => $artwork['x'],
            ':y'     => $artwork['y'],
        ]);
    }
}

$db_last_stmt = null;

function db_query($sql) {
    global $db, $db_last_stmt;
    $db_last_stmt = $db->query($sql);
    return $db_last_stmt;
}

function db_fetch_assoc($stmt) {
    return $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
}

function db_num_rows($stmt) {
    return $stmt ? count($stmt->fetchAll(PDO::FETCH_ASSOC)) : 0;
}

function db_affected_rows() {
    global $db_last_stmt;
    return $db_last_stmt ? $db_last_stmt->rowCount() : 0;
}
