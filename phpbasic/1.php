<html>

<head>
</head>

<body>
    <form method="POST">
        <h3>Input your number:</h3>
        <input type="text" name="input_number">
        <input type="submit" name="OK">
    </form>
    <php
    $num = $_POST(input_number);
    echo $num;
    ?>
</body>

</html>
<?php
$num = readline("enter a number:");
$months = array(
    1 => "January",
    2 => "February",
    3 => "March",
    4 => "April",
    5 => "May",
    6 => "June",
    7 => "July",
    8 => "August",
    9 => "September",
    10 => "October",
    11 => "November",
    12 => "December"
);
if (array_key_exists($num, $months)) {
    echo $month[$num];
}
?>