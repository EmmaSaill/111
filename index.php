<?php
$myfile = fopen("temp.txt", "r") or die("Unable to open file!");
// 输出单字符直到 end-of-file
while(!feof($myfile)) {
  echo fgetc($myfile);
}
fclose($myfile);
<html>
  <head>
    <meta charset="utf-8">
    <title>Processing.js</title>
    <script src="processing.js"></script>
  </head>
  <body>
    <h1>Processing.js</h1>

    <script type="text/processing">

      

      int light_val;
      int temp_val;
      int[] light = new int[150];
      int[] temp = new int[150];//which is 700/5 

      int counter=0;
      int i;
      int move;
      
      void setup() { 
        size(700,500); 
        for(i=0;i<temp.length;i++)
        temp[i]=500;
        for(i=0;i<light.length;i++)
        light[i]=500; //no income 
        background(25);
        smooth(8); //make curve smooth
//setting port
      } 
      
      void draw(){
 

        background(25);
        
        stroke(255);
        line(25,0,25,500);
        fill(255);
        text("LIGHT LEVEL",30,25);
        for(i=400;i>=120;i-=20)
        {
          line(25,i,30,i);
          if(i%40==0)text(4*(400-i),32,i+5);
        }//drawing y-axis for light level whith white line
        
        text("TIME(s)",350,475);//time unit
        
        stroke(87);
        line(675,0,675,500);
        fill(150);
        text("TEMPERATURE(°C)",560,25);
        int temp_coordinate;
        for(i=400;i>=120;i-=20)
        {
          line(670,i,675,i);
          temp_coordinate=(400-i)/10+10;//set area display
          if(i%40==0)text(temp_coordinate,650,i+5);
        }//drawing y-axis for temperature with grey line
        
        
        
      
          
        move+=5;//5 units per income value
        translate(-move,0);
        for(i=0;i<6000;i+=100){
        stroke(255);
        text(i/10,694+i,490); //100 units = 10 seconds
        line(699+i,495,699+i,500);} //time line
        
        delay(500);//same as Arduino delay time

      }
    </script>

    <canvas></canvas>
  </body>
</html>
?>
