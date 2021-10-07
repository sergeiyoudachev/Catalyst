<?php 
/* function Hundred print "bar," when number divisible by five(5) and less than 100, and print  "bar." when number is 100. */
function Hundred($num){
 if($num==100){
 echo "bar.";
 }else {
      echo "bar,";
 }
}

for($i=1; $i<101;$i++){
  if($i%3==0 && $i%5==0){
    echo "foobar,";
       }elseif($i%3==0){
            echo "foo,";
       }elseif($i%5==0){
            Hundred($i);
       }else {
        echo $i .",";
        }
}



?>