<?php
require_once("../config.php");
require_once("../auth.php");

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
            left: -50px;
            margin-top: 20px;
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
            background-color: skyblue;
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
            <li class="active" id="second"></li>
            <li id="third"></li>
        </ul>
        <form action="checkout-success.php" method="post">
            <div class="row">
                <ul id="product-list">
                    <?php
                    function disc($price, $disc)
                    {
                        $tdisc = ($disc / 100) * $price;
                        $result = $price - $tdisc;
                        return $result;
                    }
                    $productCode = $_POST["product_code"];
                    $sql = "SELECT * FROM product WHERE product_code= :productCode";
                    $stmt = $db->prepare($sql);

                    foreach ($productCode as $code) {
                        # code...
                        // bind parameter ke query
                        $params = array(
                            ":productCode" => $code,
                        );

                        $stmt->execute($params);

                        while ($row = $stmt->fetch()) {
                            # code...
                            echo "<li class='mb-3'> <input type='hidden' name='product_code[]' value='".$row["product_code"]."'>
                <div class='d-flex w-50 justify-content-start'>
                <a href='detail.php?product_code=" . $row["product_code"] . "'>
                    <div class='box'></div>
                </a>
                <div style='padding-left:20px'>
                    <span>" . $row["product_name"] . "</span><br>
                    <input class='w-25' type='text' name='qty[]' id='" . $row["product_code"] . "' oninput='qtyChange(this, " . ($row["discount"] !== null ? disc($row["price"], $row["discount"]) : $row["price"]) . ")' required> <span>" . $row["unit"] . "</span><br>
                    <input class='subtotal' type='text' id='subtotal_" . $row["product_code"] . "' name='subtotal[]' value='" . ($row["discount"] !== null ? disc($row["price"], $row["discount"]) : $row["price"]) . "' hidden>          
                    <span id='subtotal-text_" . $row["product_code"] . "'>Subtotal: Rp. " . ($row["discount"] !== null ? disc($row["price"], $row["discount"]) : $row["price"]) . "</span><br>
                </div>
                </div>
            </li>";
                        }
                    }
                    ?>
                </ul>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-6 text-center">                    
                        <h4 class="border border-50 w-100 py-1 px-3">TOTAL: <span id="total">Rp. 0</span></h4>
                        <input type="text" name="total" id="input-total" hidden>
                    </div>
                </div>
                <div class="col-2"></div>
                <button class="btn btn-primary w-50" type="submit">Checkout</button>
            </div>
        </form>
    </div>
    <script>
        function qtyChange(val, initPrice) {
            let subtotal = document.getElementById('subtotal_' + val.getAttribute('id'));
            tempSub = initPrice;
            if (val.value.length == 0) {
                document.getElementById('subtotal_' + val.getAttribute('id')).value = tempSub;
                document.getElementById('subtotal-text_' + val.getAttribute('id')).innerHTML = "Subtotal: Rp. " + subtotal.value;
            }
            if (val.value.length > 0) {
                let result = val.value * tempSub;
                document.getElementById('subtotal_' + val.getAttribute('id')).value = result;
                document.getElementById('subtotal-text_' + val.getAttribute('id')).innerHTML = "Subtotal: Rp. " + subtotal.value;                
            }
            calculateTotal()
        }

        function calculateTotal() {
            let subtotalInputs = document.querySelectorAll('.subtotal');
            let total = 0;

            subtotalInputs.forEach(function (input) {
                let value = parseFloat(input.value);
                if (!isNaN(value)) {
                    total += value;
                }
            });

            document.getElementById('input-total').value = total;
            document.getElementById('total').innerHTML = "Rp. " + total;
        }

    </script>
</body>

</html>