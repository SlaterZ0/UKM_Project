<?php
include_once 'products_crud.php';
include_once 'session.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TC Empire Ordering System : Products</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">





  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">




</head>

<body>

  <?php include_once 'nav_bar.php'; ?>
  <?php if ($pos === "Admin") { ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header">
            <h2>Create New Product</h2>
          </div>

          <form action="products.php" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="productid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if (isset($_GET['edit'])) echo $editrow['PRODUCTS_ID']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="productname" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-9">
                <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if (isset($_GET['edit'])) echo $editrow['PRODUCTS_NAME']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="productprice" class="col-sm-3 control-label">Price(USD)</label>
              <div class="col-sm-9">
                <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if (isset($_GET['edit'])) echo $editrow['PRICE']; ?>" min="0.0" step="0.01" required>
              </div>
            </div>

            <div class="form-group">
              <label for="producttype" class="col-sm-3 control-label">Type</label>
              <div class="col-sm-9">
                <input name="type" type="text" class="form-control" id="producttype" placeholder="Product Type" value="<?php if (isset($_GET['edit'])) echo $editrow['TYPE']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="productrarity" class="col-sm-3 control-label">Rarity</label>
              <div class="col-sm-9">
                <select name="rarity" class="form-control" id="productrarity" required>
                  <option value="">Please select</option>
                  <option value="Ultra Rare" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Ultra Rare") echo "selected"; ?>>Ultra Rare</option>
                  <option value="Secret Rare" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Secret Rare") echo "selected"; ?>>Secret Rare</option>
                  <option value="Extremely Rare" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Extremely Rare") echo "selected"; ?>>Extremely Rare</option>
                  <option value="Rare" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Rare") echo "selected"; ?>>Rare</option>
                  <option value="Uncommon" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Uncommon") echo "selected"; ?>>Uncommon</option>
                  <option value="Common" <?php if (isset($_GET['edit'])) if ($editrow['RARITY'] == "Common") echo "selected"; ?>>Common</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="set" class="col-sm-3 control-label">Set</label>
              <div class="col-sm-9">
                <select name="set" class="form-control" id="set" required>
                  <option value="">Please select</option>
                  <option value="XY Promos" <?php if (isset($_GET['edit'])) if ($editrow['SETS'] == "XY PROMOS") echo "selected"; ?>>XY Promos</option>
                  <option value="Unseen Forces" <?php if (isset($_GET['edit'])) if ($editrow['SETS'] == "Unseen Forces") echo "selected"; ?>>Unseen Forces</option>
                  <option value="Team Rocket Returns" <?php if (isset($_GET['edit'])) if ($editrow['SETS'] == "Team Rocket Returns") echo "selected"; ?>>Team Rocket Returns</option>
                  <option value="2020 Topps" <?php if (isset($_GET['edit'])) if ($editrow['SETS'] == "2020 Topps") echo "selected"; ?>>2020 Topps</option>
                  <option value="1990 Topps" <?php if (isset($_GET['edit'])) if ($editrow['SETS'] == "1990 Topps") echo "selected"; ?>>1990 Topps</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="productq" class="col-sm-3 control-label">Quantity</label>
              <div class="col-sm-9">
                <input name="quantity" type="number" class="form-control" id="productq" placeholder="Product Quantity" value="<?php if (isset($_GET['edit'])) echo $editrow['QUANTITY']; ?>" min="0" required>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php if (isset($_GET['edit'])) { ?>
                    <input type="hidden" name="oldpid" value="<?php echo $editrow['PRODUCTS_ID']; ?>">
                    <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
                  <?php } else { ?>
                    <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
                  <?php } ?>
                  <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
                </div>
              </div>

          </form>
        </div>
      </div>
    </div>
  <?php } ?>






  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Product List</h2>
      </div>
      <table id="product-table" class="table table-striped table-bordered">
        <thead>
          <tr style="font-weight:bold; background-color: #E9967A;">
            <th>Product ID</th>
            <th>Name</th>
            <th>Price (USD)</th>
            <th>Type</th>
            <th>Rarity</th>
            <th>Set</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Read
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("select * from tbl_products_a187103");
            $stmt->execute();
            $result = $stmt->fetchAll();
          } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
          foreach ($result as $readrow) {
          ?>
            <tr>
              <td><?php echo $readrow['PRODUCTS_ID']; ?></td>
              <td><?php echo $readrow['PRODUCTS_NAME']; ?></td>
              <td><?php echo $readrow['PRICE']; ?></td>
              <td><?php echo $readrow['TYPE']; ?></td>
              <td><?php echo $readrow['RARITY']; ?></td>
              <td><?php echo $readrow['SETS']; ?></td>

              <td>
                <button data-href="products_details.php?pid=<?php echo $readrow['PRODUCTS_ID']; ?>" class="btn btn-warning btn-xs btn-details" role="button">Details</button>

                <?php if ($pos === "Admin") { ?>
                  <a href="products.php?edit=<?php echo $readrow['PRODUCTS_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                  <a href="products.php?delete=<?php echo $readrow['PRODUCTS_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                <?php } ?>
              </td>
            </tr>
          <?php
          }
          $conn = null;
          ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="bs-example">

    <div id="myModal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Product Details</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="js/bootstrap.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>



  <script>
    $(document).ready(function() {

      var table = $('#product-table').DataTable({
        "order": [
          [1, "asc"]
        ],
        "pagingType": "full_numbers",
        "pageLength": 5,
        "lengthMenu": [
          [5, 10, 20, 30, -1],
          [5, 10, 20, 30, "All"]
        ],
        "searching": true,
        "columnDefs": [{
          "searchable": false,
          "targets": 2
        }],
        "dom": 'lBfrtip',
        "buttons": [{
          extend: 'excelHtml5',
          text: 'Excel',
          exportOptions: {
            columns: [0, 1, 2, 3]
          },
          className: 'btn btn-primary'
        }]
      });



      $('#product-table tbody').on('click', 'button.btn-details', function() {
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL, function() {
          $('#myModal').modal({
            show: true
          });
        });
      });


      var exportContainer = $('<div class="export-container"></div>').insertAfter('.dataTables_info');
      table.buttons().container().appendTo(exportContainer);


      $('.export-container .btn-primary').removeClass('btn-secondary').addClass('btn-primary');
    });
  </script>


</body>

</html>