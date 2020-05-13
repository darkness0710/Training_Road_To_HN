<?php

$myArray = array(1, 2, 3);


Homework1($myArray);
Homework2($myArray);
Homework3($myArray);
Homework4($myArray, 1);

function Homework1($array)
{
    echo "Homework 1: <br> ---------------- <br>";
    //push 0 vao dau
    array_unshift($array, '0');
    echo "mang sau khi them: <br>";
    print_r($array);
    echo "<br><br>";
}
function Homework2($array)
{
    echo "Homework 2: <br> ---------------- <br>";
    //push 4 vao cuoi
    array_push($array, '4');
    echo "mang sau khi them: <br>";
    print_r($array);
    echo "<br><br>";
}

function Homework3($array)
{
    echo "Homework 3: <br> ---------------- <br>";
    //dem so phan tu
    echo "so phan tu cua mang: <br>" . count($array);
    echo "<br><br>";
}
function Homework4($array, $num)
{
    echo "Homework 4: <br> ---------------- <br>";
    //xoa phan tu chi dinh
    if (in_array($num, $array)) {
        $key = array_search($num, $array);
        array_splice($array, $key, 1);
    } else {
        echo 'can not find the element';
    }
    print_r($array);
    echo "<br><br>";
}
