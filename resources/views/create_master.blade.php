<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Creat master</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
​
​
    <style>
      .crd{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;
      }
        .print {visibility:visible;}
        @media print {
        .bt {
         display: none;
         }
        body {
        width:100%!important;
        padding:0!important;
        margin:0!important;
        }
        }
        @page {
        margin: 2cm;
        }
​
    </style>
</head>
<body>
​
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav container">
          <li class="nav-item active">
            <a class="nav-link" href="create master.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
    </nav>
​
    <div class="container mt-5">
      <div class="card bg-light crd">
        <div class="card-body">
​
          <form action = "{{url('/master_invoice')}}" method="post">
          @csrf
            <div class="row mt-3">
              <div class="col-4">
                <div class="form-inline">
                  <label for="Name">Name:</label>
                  <input type="text" class="form-control ml-2" placeholder="Name" name="name" id="name">
                </div>
              </div>

              <div class="col-4">
                <div class="form-inline">
                  <label for="Date">Date:</label>
                  <input type = "text" class="form-control datepicker-1 ml-2" placeholder="Select Date" name="date" id="date" >
                </div>
              </div>
            </div>
​
            <div class="row mt-4">
              <div class="col">
                <div class="form-group">
                  <label for="Category">Add Category</label>
                    <select class="form-control" name="category" id="category">
                        <option  value="">Select Category</option>
                        @foreach($category as $category)
                        <option  value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
            </div>


            <div class="row mt-4">
                <div class="col">
                  <table class="table"  id="mytable">
                    <thead>
                      <tr>
                      <th>Sr No.</th>
                      <th>Items</th>
                      <th>Qty</th>
                      <th>Unit Price</th>
                      <th>Price</th>
                      <th>Add</th>
                      </tr>
                    </thead>
​
                    <tbody>
                            <tr id="line_items-group" class="form-group">
                              <td></td>
                              <td><input type="text" class="form-control" name="iname" id="line_items"></td>
                              <td><input type="number" min="" max="" value="1" class="form-control text-center" name="quantity"  id="line_items"></td>
                              <td><input type="number" min="" max="" value="1" class="form-control text-center" name="unit_price" id="line_items"></td>
                              <td></td>
                              <td><button type="button" class="btn btn-primary">+</button></td>
                            </tr>
​
                      <tr>
                      <td></td>
                      <td></td>
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
​
              <div class="text-center mt-5">
                <button type="submit" class="btn btn-primary" id="add">Create Invoice</button>
              </div>
          </form>
​
<!----<button type="button" class="btn btn-primary bt" data-toggle="modal" data-target="#myModal">
    Create Invoice
    </button>

​
    <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">


        <div class="modal-header">
          <h4 class="modal-title justify-content-center">Invoice Created</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>


        <div class="modal-body">
            <table class="table table-borderless">
                <tr>
               <th>Name</th>
               <th>Total</th>
               <th class="text-right"><a target="_blank" onclick="window.open('invoive.html','name','width=1000,height=630')" class="btn btn-primary" role="button">View</a></th>
               <th class="text-right"><a class="btn btn-primary b" role="button">Print</a></th>
               </tr>
            </table>
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-danger text-right" data-dismiss="modal">Print All</button>
        </div>

      </div>
    </div>
    </div>
    </div>

​

</body>
</html>

<script type="text/javascript">

$(function() {
$( ".datepicker-1" ).datepicker({ dateFormat:"yy-mm-dd",});
});

$('form').submit(function(event) {
var formdata = {
            "name": $('input[name=name]').val(),
            "date": $('input[name=date]').val(),
            "category": $('input[name=category]').val(),
            "line_items": [{
                           "item": $('input[name=iname]').val(),
                           "unit_price":$('input[name="unit_price"]').val(),
                           "qty":$('input[name="quantityty"]').val(),
                             }]
           }
$.ajax({
type        : 'POST',
url         : 'localhost:8000/master_invoice',
data        : formdata,

           encode: false
})
.done(function(data) {
console.log(data);
});
event.preventDefault();
});
​
/*   $( "#add" ).click(function() {

var newElement = '<tr><td></td><td><input type="text" class="form-control" name="item"/></td><td><input type="number" name="qty" min="1" max="10" value="1" class="form-control text-center"/></td><td><input type="number" name="unit_price" min="1" max="50000" value="1" class="form-control text-center/></td><<td></td><td><button type="submit" class="btn btn-primary" id="add">+</button></td></tr>';
$( "#mytable" ).append( $(newElement) );

});  */

</script>
