<?php
$myfile = fopen("temp.txt", "r") or die("Unable to open file!");
// 输出单字符直到 end-of-file
while(!feof($myfile)) {
  echo fgetc($myfile);
}
fclose($myfile);
$a=file_get_contents('temp.txt');
　　$a=preg_replace('/\n|\r\n/','bj',$a);
　　echo $a;
?>
