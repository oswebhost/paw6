<?php

/*
echo "<br>1s<br>";
$x = p1s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";



echo "<br><br>2s<br>";
$x = p2s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";


echo "<br><br>3s<br>";
$x = p3s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";


echo "<br><br>4s<br>";
$x = p4s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";

echo "<br><br>5s<br>";
$x = p5s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";

echo "<br><br>6s<br>";
$x = p6s(6);
echo $x->combinations . "<br>"; 
echo $x->counts . "<br>";

print_r(explode(",",$x->combinations))1;

*/

function p6s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $_i2 = $__PX+1;
    
    for ($_l2=$_i2; $_l2<=$noutof; $_l2++){
      
       $_i3 = $_l2+1;
       
       for ($_l3=$_i3; $_l3<=$noutof; $_l3++){   
      
          $_i4 = $_l3+1;
          
           for ($_l4=$_i4; $_l4<=$noutof; $_l4++){
           
             $_i5 = $_l4+1; 
             
             for ($_l5=$_i5; $_l5<=$noutof; $_l5++){
                
                $_i6 = $_l5+1;
                
                for ($_l6=$_i6; $_l6<=$noutof; $_l6++){      
                    $cstring .= $__PX . "," . $_l2 ."," . $_l3 . "," . $_l4 . "," . $_l5 . "," . $_l6 . "|";
                }
             }
           }
       }
    
    }
    
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =6;
  
  return $combi ; 
  
} 


function p5s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $_i2 = $__PX+1;
    
    for ($_l2=$_i2; $_l2<=$noutof; $_l2++){
      
       $_i3 = $_l2+1;
       
       for ($_l3=$_i3; $_l3<=$noutof; $_l3++){   
      
          $_i4 = $_l3+1;
          
           for ($_l4=$_i4; $_l4<=$noutof; $_l4++){
           
             $_i5 = $_l4+1; 
             
             for ($_l5=$_i5; $_l5<=$noutof; $_l5++){
                
                $cstring .= $__PX . "," . $_l2 ."," . $_l3 . "," . $_l4 . "," . $_l5 . "|";
             }
           }
       }
    
    }
    
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =5;
  
  return $combi ; 
  
} 


function p4s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $_i2 = $__PX+1;
    
    for ($_l2=$_i2; $_l2<=$noutof; $_l2++){
      
       $_i3 = $_l2+1;
       
       for ($_l3=$_i3; $_l3<=$noutof; $_l3++){   
      
          $_i4 = $_l3+1;
          
           for ($_l4=$_i4; $_l4<=$noutof; $_l4++){
           
             $cstring .= $__PX . "," . $_l2 ."," . $_l3 . "," . $_l4 . "|";
           }
       }
    
    }
    
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =4;
  
  return $combi ; 
  
} 


function p3s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $_i2 = $__PX+1;
    
    for ($_l2=$_i2; $_l2<=$noutof; $_l2++){
      
       $_i3 = $_l2+1;
       
       for ($_l3=$_i3; $_l3<=$noutof; $_l3++){   
      
            $cstring .= $__PX . "," . $_l2 ."," . $_l3 . "|";
       }
    
    }
   
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =3;  
  return $combi ;      

} 


function p2s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $_i2 = $__PX+1;
    
    for ($_l2=$_i2; $_l2<=$noutof; $_l2++){
      
      $cstring .= $__PX . "," . $_l2 . "|";
    }
    
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =2;
  
  return $combi ; 

} 



function p1s($noutof){

  $nCombines = 0 ;
  $cstring = "";
  
  for($__PX=1; $__PX<=$noutof; $__PX++) {
    
    $cstring .= $__PX . "|";
    
  }
  $new_string = substr($cstring,0,strlen($cstring)-1) ;
  $ncount = explode("|", $new_string);

  $combi = new stdClass();
  $combi->combinations = $new_string;
  $combi->counts = count($ncount);
  $combi->type =1;
  
  return $combi ; 

} 

?>