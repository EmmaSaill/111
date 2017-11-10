<?php
$myfile = fopen("temp.txt", "r") or die("Unable to open file!");
// 输出单字符直到 end-of-file
while(!feof($myfile)) {
  echo fgets($myfile);
  echo "</br>";
}
fclose($myfile);
?>
