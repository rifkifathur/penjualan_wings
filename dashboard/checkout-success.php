<?php
require_once("../config.php");
require_once("../auth.php");

$auth = $_SESSION['user'];
$codeDoc = "TRX";
$docNumber = "001";
$codeProduct = $_POST['product_code'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];
$total = $_POST['total'];

$sql = "SELECT max(doc_number) FROM transaction_header";
$stmt = $db->query($sql);
$tempDocNum = $stmt->fetch();

$urutan = (int) substr($tempDocNum[0], 0, 3);

$urutan++;

// menyiapkan query
$sql1 = "INSERT INTO transaction_detail (code_doc, doc_number, code_product, quantity, sub_total) 
        VALUES (:codeDoc, :docNumber, :codeProduct, :qty, :subtotal)";
$stmt1 = $db->prepare($sql1);

// bind parameter ke query
foreach ($codeProduct as $key => $code) {
    # code...
    $params1 = array(
        ":codeDoc" => $codeDoc,
        ":docNumber" => sprintf("%03s", $urutan),
        ":codeProduct" => $code,
        ":qty" => $qty[$key],
        ":subtotal" => $subtotal[$key],
    );
    // eksekusi query untuk menyimpan ke database
    $saved1 = $stmt1->execute($params1);
}

$sql2 = "INSERT INTO transaction_header (doc_code, doc_number, user_id, total, date) 
            VALUES (:codeDoc, :docNumber, :userId, :total, :date)";
$stmt2 = $db->prepare($sql2);

$params2 = array(
    ":codeDoc" => $codeDoc,
    ":docNumber" => sprintf("%03s", $urutan),
    ":userId" => $auth["id"],
    ":total" => $total,
    ":date" => Date("Y-m-d"),
);

// eksekusi query untuk menyimpan ke database
$saved2 = $stmt2->execute($params2);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Checkout</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
    <style>
        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: skyblue;
        }

        #progressbar li {
            list-style-type: none;
            font-size: 12px;
            width: 25%;
            float: left;
            position: relative;
        }

        /*Icons in the ProgressBar*/
        #progressbar #first:before {
            content: "";
        }

        #progressbar #second:before {
            content: "";
        }

        #progressbar #third:before {
            content: "";
        }

        /*ProgressBar before any progress*/
        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px;
        }

        /*ProgressBar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 30px;
            top: 25px;
            z-index: -1;
        }

        #progressbar li:last-child li:after {
            display: none;
        }

        #progressbar .active {
            color: #000000;
        }

        .box {
            content: "";
            width: 100px;
            height: 100px;
            background-color: cadetblue;
        }

        #product-list {
            list-style: none;
        }

        /* Style the checkbox button container */
        .custom-checkbox-input {
            display: none;
        }

        .custom-checkbox-text {
            padding: 10px;
            border-radius: 10px;
            background-color: skyblue;
            color: #555;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox-input:checked~.custom-checkbox-text {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <div class="w-50 m-auto container my-5">
        <ul id="progressbar">
            <li id="first"></li>
            <li id="second"></li>
            <li class="active" id="third"></li>
        </ul>
        <h3>Terimakasih</h3>
    </div>
</body>

</html>