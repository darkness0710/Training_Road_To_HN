<!-- $strings = array("Austin is the capital of Texas.",
                 "There are 50 states in the United States of America",
                 "There is no better joke about muffins and an oven than this one:",
                 "There are two muffins are in an oven...",
                 "One says to the other: God it is hot in here",
                 "The other one replies: Oh no... It's a talking muffin");
Bài 1. Tính tổng sứ chữ cái không bào gồm khoảng trắng của mảng trên
Bài 2. In ra các kí tự và số lần xuất hiện
Bài 3.Tinh số khoảng trắng
Bài 4. Đếm số in hoa và in thường
 -->
<?php
$strings = array(
    "Austin is the capital of Texas.",
    "There are 50 states in the United States of America",
    "There is no better joke about muffins and an oven than this one:",
    "There are two muffins are in an oven...",
    "One says to the other: God it is hot in here",
    "The other one replies: Oh no... It's a talking muffin"
);
Homework1($strings);
Homework2($strings);
Homework3($strings);
Homework4($strings);

function Homework1($array)
{
    //Bài 1. Tính tổng sứ chữ cái không bào gồm khoảng trắng của mảng trên
    echo "Homework 1: <br> ---------------- <br>";
    $count = 0;
    foreach ($array as  $value) {
        $count += strlen(trim($value));
    }
    echo "Tong so chu cai cua mang la:" . $count . "<br>";
    echo "<br><br>";
}

function Homework2($array)
{
    //Bài 2. In ra các kí tự và số lần xuất hiện
    echo "Homework 2: <br> ---------------- <br>";
    $longString = '';
    foreach ($array as  $value) {
        $longString = $longString . $value;
    }
    echo "So lan xuat hien cac ky tu:";
    echo "<br>";
    foreach (count_chars($longString, 1) as $chr => $val) {
        echo chr($chr) . " appears " . $val . " time(s) <br>";
    };
    echo "<br><br>";
}

function Homework3($array)
{
    //Bài 3. Tinh số khoảng trắng
    echo "Homework 3: <br> ---------------- <br>";
    $longString = '';
    foreach ($array as  $value) {
        $longString .= $value;
    }
    echo "So lan xuat hien khoang trang:" . substr_count($longString, ' ');;
    echo "<br><br>";
}

function Homework4($array)
{
    //Bài 4. Tinh số khoảng trắng
    echo "Homework 4: <br> ---------------- <br>";
    $longString = 0;
    $capCharNumber=0;
    $norCharNumber=0;
    foreach ($array as  $value) {
        $longString .= $value;
    }
    foreach (count_chars($longString, 1) as $chr => $val) {
        if ($chr >= 65 && $chr <= 90) {
            $capCharNumber += 1;
        } else if (($chr >= 90 && $chr <= 126)) {
            $norCharNumber += 1;
        }
    };

    echo "So ky tu Viet Hoa: ".$capCharNumber." so ky tu thuong: ".$norCharNumber;
    echo "<br><br>";
}

?>