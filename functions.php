<?php

function execWithotParams(PDO $connection, string $sql) {
    $sttm = $connection->prepare($sql);
    return $sttm->execute();
}
