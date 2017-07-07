<?php
$p = isset($_GET['p']) ? $_GET['p'] : 1;
$fp = fopen($p . ".pdf", "r");

header("Content-type: application/pdf");

fpassthru($fp);

fclose($fp);