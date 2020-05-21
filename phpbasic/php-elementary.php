<!DOCTYPE Html>
<html>

<head>
    <title>Giai phuong trinh bac mot</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php
    $result = '';
    if (isset($_POST['calculate'])) {
        // Bước 1: Lấy thông tin
        $a = isset($_POST['a']) ? (float) trim($_POST['a']) : '';
        $b = isset($_POST['b']) ? (float) trim($_POST['b']) : '';

        // Bước 2: Validate thông tin và tính toán
        if ($a == '') {
            $result = 'Bạn chua nhập số a';
        } else if ($b == '') {
            $result = 'Bạn chưa nhập số b';
        } else if ($a == 0) {
            $result = 'Số a phải nhập khác 0';
        } else {
            $result = - ($b) / $a;
        }
    }



    ?>
    <h1>Giai phuong trinh bac mot</h1>
    <form action="" method="post">
        <input type="text" name="a" id="" value="" width="20px" />
        x +
        <input type="text" name="b" id="" value="" width="20px" />
        = 0
        <br><br>
        <input type="submit" value="Tinh" name="calculate" />
    </form>
    <?php echo $result; ?>

</body>

</html>