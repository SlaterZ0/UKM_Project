<?php
include_once 'database.php';
?>
<?php
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM tbl_orders_a187103, tbl_staffs_a187103,
    tbl_customers_a187103, tbl_orders_details_a187103 WHERE
    tbl_orders_a187103.Staff_ID = tbl_staffs_a187103.Staff_ID AND
    tbl_orders_a187103.Customer_ID = tbl_customers_a187103.Customer_ID AND
    tbl_orders_a187103.Order_ID = tbl_orders_details_a187103.Order_ID AND
    tbl_orders_a187103.Order_ID = :oid");
  $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
  $oid = $_GET['oid'];
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>

      <div class="row">
        <div class="col-xs-6 text-center">
          <br>
          <img src="logo.png" width="30%" height="30%">
        </div>
        <div class="col-xs-6 text-right">
          <h1>INVOICE</h1>
          <h5>Order: <?php echo $readrow['Order_ID'] ?></h5>
          <h5>Date: <?php echo $readrow['Order_Date'] ?></h5>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>From: TC Empire Sdn. Bhd.</h4>
            </div>
            <div class="panel-body">
              <p>
                TC Empire<br>
                11, Balakong Selangor MY,<br>
                Jalan One Industrial Park 2<br>
                43300 <br>
                Seri Kembangan, Selangor. <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>To : <?php echo $readrow['Customer_Name']; ?></h4>
            </div>
            <div class="panel-body">
              <p>
                Customer Address : <?php echo $readrow['fld_customer_address']; ?><br>
              </p>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-bordered">
        <tr>
          <th>No</th>
          <th>Product</th>
          <th class="text-right">Quantity</th>
          <th class="text-right">Price(USD)/Unit</th>
          <th class="text-right">Total(USD)</th>
        </tr>
        <?php
        $grandtotal = 0;
        $counter = 1;
        try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a187103,
            tbl_products_a187103 where 
            tbl_orders_details_a187103.Product_ID = tbl_products_a187103.PRODUCTS_ID AND
            Order_ID = :oid");
          $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
          echo "Error: " . $e->getMessage();
        }
        foreach($result as $detailrow) {
          ?>
          <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo $detailrow['PRODUCTS_NAME']; ?></td>
            <td class="text-right"><?php echo $detailrow['Quantity']; ?></td>
            <td class="text-right"><?php echo $detailrow['PRICE']; ?></td>
            <td class="text-right"><?php echo $detailrow['PRICE']*$detailrow['Quantity']; ?></td>
          </tr>
          <?php
          $grandtotal = $grandtotal + $detailrow['PRICE']*$detailrow['Quantity'];
          $counter++;
  } // while
  ?>
  <tr>
    <td colspan="4" class="text-right">Grand Total</td>
    <td class="text-right"><?php echo $grandtotal ?></td>
  </tr>
</table>

<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>MUHAMMAD HAZIM BIN MOHD RIZAL</p>
        <p>Malayan Banking Berhad</p>
        <p>Account Number : 162254838781</p>
      </div>
    </div>
  </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Staff Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff ID: <?php echo $readrow['Staff_ID']; ?> </p>
          <p> Staff Name: <?php echo $readrow['Staff_Name'] ?> </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>