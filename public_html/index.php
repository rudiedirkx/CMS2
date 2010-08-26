<?php

if ( empty($_GET['node']) ) {
	exit('No node?');
}

$node = (int)$_GET['node'];

echo 'Loading node '.$node."...\n";

