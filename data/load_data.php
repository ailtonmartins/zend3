<?php

$db=new PDO("mysql:localhost=127.0.0.1;dbname=clientes_teste",'root','root');

$fh = fopen(__DIR__ . '/schema.sql', 'r');
while ($line = fread($fh, 4096)) {
    print_r($line);
    $db->exec($line);
}
fclose($fh);