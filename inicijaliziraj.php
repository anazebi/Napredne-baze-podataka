<?php

$r = new Redis();
//Connecting to Redis
$r->connect('redis-14447.c135.eu-central-1-1.ec2.cloud.redislabs.com', 14447);
$r->auth('y7Lm2WBcfWwfIZHhDuSXlWRjlNvACVAa');

// DANGER ZONE
//-----------------------------------------
// dohvati sve ključeve iz baze i obriši ih
/*$allKeys = $r->keys('*');
foreach($allKeys as $key)
    $r->del($key);*/
//------------------------------------------

// postavi br_korisnika na 0
$r->set("br_korisnika", 0);

?>