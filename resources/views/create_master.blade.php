<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creat master</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>




</head>
<body>

    <div class="container">
        <div class="row mt-3">
            <div class="col-3">
                <form class="form-inline" action="/action_page.php">
                <label for="Name">Name:</label>
                <input type="text" class="form-control ml-1" placeholder="Name" id="name">
                </form>
            </div>

            <div class="col-3">
                <form class="form-inline" action="/action_page.php">
                <label for="Date">Date:</label>
                <input type = "text" class="form-control ml-1" id = "datepicker-1">
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="form-group position-relative">
                    <label for="Pieces">Add Category</label>
                    <select class="form-control">
                            <option  value="0">Category</option>
                            <option  value="1"></option>
                            <option value="2"></option>
                          </select>
                </div>
            </div>
        </div>


    <div class="row">
        <div class="col">
                <table class="table border-bottom">
                <thead>
                <tr>
                <th>Sr No.</th>
                <th>Items</th>
                <th>qby</th>
                <th>unit</th>
                <th>Price</th>
                <th>Add</th>
                </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td></td>
            <td><input type="number" name="quantity" min="1" max="10" value="1" class="form-control text-center"></td>
            <td><input type="number" name="quantity" min="1" max="10" value="1" class="form-control text-center"></td>
            <td></td>
            <td><button type="button" class="btn btn-primary add-row">+</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td >Total</td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
        </div>
        </div>

    <h1 class="border text-center mt-3">Master Line view</h1>
        <!-- Button to Open the Modal -->

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Create Invoice
    </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title justify-content-center">Invoice Created</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <table class="table table-borderless">
                <tr>
               <th>Name</th>
               <th>Total</th>
               <th class="text-right"><a href="view" class="btn btn-primary" role="button">View</a></th>
               <th class="text-right"><button  onclick="window.print()" class="btn btn-primary" role="button">Print</button></th>
               </tr>
            </table>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger text-right" data-dismiss="modal">Print All</button>
        </div>

      </div>
    </div>
    </div>


    <script type="text/javascript">
       // $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});

        $(function() {
            $( "#datepicker-1" ).datepicker({

               dateFormat:"yy-mm-dd",

            });
         });

    </script>

</body>
</html>
