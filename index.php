<!DOCTYPE HTML>
<html>
<head>
<title>Data</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/boot.css">
<!--<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">-->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/css/style_common.css">
<link rel="stylesheet" type="text/css" href="assets/css/style1.css">
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic'>
<script src="assets/js/modernizr.custom.69142.js"></script>
<script src="assets/js/jquery-1.10.1.min.js"></script>
<script src="assets/js/bootstrap.min.js" ></script>
</head>
<body>
<div id="page-top" class="index">
  
<!-- Data  -->
<section id="Datas">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="timeline">
            <li class="timeline-inverted">
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4 style="color:#3680C1"></h4>
                    <h4 class="subheading" style="color:#3680C1">
                    <p style = "font-size: 20px;"><b>Light Level(0-1024)</b></p>
                    </h4>
                  </div>
                  <div class="timeline-body">
<p>
<?php
$myfile = fopen("temp.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
  echo fgets($myfile);
  echo "</br>";
}
fclose($myfile);
?>
</p>
                  </div>
                </div>
            <div class="timeline-inverted">    
                <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 style="color:#3680C1"></h4>
                    <h4 class="subheading" style="color:#3680C1">
                    <p style = "font-size: 20px;"><b>Temperature(°C)</b></p>
                    </h4>
                </div>
                <div class="timeline-body">
<p>
<?php
$myfile = fopen("temp.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
echo fgets($myfile);
echo "</br>";
}
fclose($myfile);
?>
</p>
                </div>
                </div>
            </div>    
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
