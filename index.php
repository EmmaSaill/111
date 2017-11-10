<?php

$a=file_get_contents("temp.txt");
　　$a=preg_replace("/\n|\r\n/","bj",$a);
　　echo $a;
?>
