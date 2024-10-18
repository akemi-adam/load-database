<?php

require_once __DIR__ . 'vendor/autoload.php';

require __DIR__ . '/functions.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $connection = new PDO(
        'mysql:host=' . getenv('DB_HOST') . ';charset=UTF8',
        getenv('DB_USER'),
        getenv('DB_PASS'),
    );
} catch (PDOException $e) {
    print "Erro na conexão:\n" . $e->getMessage();
    exit();
}

$file = file_get_contents(getenv('FILE_FOLDER') . '/' . $argv[1] . '.sql');

execWithotParams($connection, "DROP DATABASE IF NOT EXISTS " . getenv('DB_NAME'));
execWithotParams($connection, "CREATE DATABASE IF NOT EXISTS " . getenv('DB_NAME'));
execWithotParams($connection, "USE " . getenv('DB_NAME'));
if (execWithotParams($connection, $file)) {
    echo "Backup realizado com sucesso!";
} else {
    echo "Erro no backup!";
}
