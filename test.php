<?php
 
$r = new Redis();
//Connecting to Redis
$r->connect('redis-14447.c135.eu-central-1-1.ec2.cloud.redislabs.com', 14447);
$r->auth('y7Lm2WBcfWwfIZHhDuSXlWRjlNvACVAa');

// dohvati sve ključeve iz baze i obriši ih
/*$allKeys = $r->keys('*');
foreach($allKeys as $key)
    $r->del($key);*/

$allKeys = $r->keys('*');
foreach($allKeys as $key){
    var_dump($key);
    var_dump($r->hMGet($key, ["username", "password", "ime", "prezime"]));
    echo "\n";
}

var_dump($r->hGet("anka", "username"));

?>
