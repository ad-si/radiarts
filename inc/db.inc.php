<?php

$db = new PDO('sqlite:' . __DIR__ . '/../dbs/index.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
