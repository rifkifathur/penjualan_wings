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
  <title>Product</title>
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

    #progressbar li.active:before, #progressbar li.active:after {
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
      left: 20px;
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
  <a class="btn btn-primary" href="../logout.php">Logout</a>
  <a href="pdf.php" target="_blank" class="btn btn-success">Report</a>
    <ul id="progressbar">
      <li class="active" id="first"></li>
      <li id="second"></li>
      <li id="third"></li>
    </ul>
    <form action="checkout.php" method="post">
      <div class="row">
      <?php
            function disc($price, $disc){
              $tdisc = ($disc/100)*$price;
              $result = $price-$tdisc;
              return $result;
            }

            $sql = "SELECT * FROM product";
            $stmt = $db->query($sql);
            while ($row = $stmt->fetch()) {
              # code...
            echo "
            <div class='col-2 mb-3'>
              <a href='detail.php?product_code=".$row["product_code"]."'>
                <div class='box'></div>
              </a>
            </div>
            <div class='col-4 mb-3'>
              <span>".$row["product_name"]."</span><br>
              <span class='".($row["discount"] !== null ? 'text-decoration-line-through' : '')."'>Rp. ".$row["price"]."</span><br>"
              .($row["discount"] !== null ? '<span>Rp. '.disc($row["price"], $row["discount"]).'</span><br>' : '')."
            </div>
            <div class='col-6 mb-3'>
            <label class='custom-checkbox'>
              <input class='custom-checkbox-input' name='product_code[]' value='".$row["product_code"]."' type='checkbox'>
              <span class='custom-checkbox-text'>Buy</span>
            </label>
            </div>
            ";
            }
          ?>
        <div class="col-2"></div>
        <button class="btn btn-primary w-50" type="submit">Checkout</button>
      </div>
    </form>
  </div>
</body>

</html>