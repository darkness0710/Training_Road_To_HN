<?php

$colors = array('red','green','blue','yellow','purple');
$numbers = array("lessthan10" => array(1,2,3,4,5,6,7,8,9),
        "lessthan20" => array(10,11,12,13,14,15,16,17,18,19));

    Homework1($colors);
    Homework2($colors);
    Homework3($numbers);

    function Homework1 ($array){
        echo "Homework 1: <br> ---------------- <br>";
        sort($array);
        echo "ascendingsort:<br>";        
        foreach( $array as  $value ){
            echo $value."<br>";
        }
        echo "<br>";        
        rsort($array);
        echo "desceningsort:<br>";
        foreach($array as $value){
            echo $value."<br>";
        }
        echo "<br><br>";
    }
    function Homework2 ($array){
        echo "Homework 2: <br> ---------------- <br>";
        foreach($array as $x){
            echo $x."<br>";
        }
        echo "<br><br>";
    }

    function Homework3 ($array){
        echo "Homework 3: <br> ---------------- <br>";
        $Sum =0;
        foreach($array as $key => $value){
            foreach($value as $k => $v){
                $Sum = $Sum + $v;      
            
            }
        }
        echo $Sum;
        echo "<br><br>";
    }