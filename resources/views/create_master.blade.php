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

    </style>
</head>
<body>

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

    <div class="container mt-5">
      <div class="card bg-light crd">
        <div class="card-body">

          <form id="form" action = {{url('/master_invoice')}} method = "post">
            @csrf
            <div class="row mt-3">
              <div class="col-4">
                <div class="form-inline">
                  <label for="Name">Name:</label>
                  <input type="text" class="form-control ml-2" placeholder="Name" name="name">
                </div>
              </div>

              <div class="col-4">
                <div class="form-inline">
                  <label for="Date">Date:</label>
                  <input type = "text" class="form-control datepicker-1 ml-2" placeholder="Select Date" name="date" >
                </div>
              </div>


            <div class="col-4 mt-4">

                  <div class="form-group">
                      <div class="form-inline">
                    <label for="Category">Category</label>
                      <select class="form-control" name="category" id="category">
                          <option  value="">Select Category</option>
                          @foreach($category as $category)
                          <option  value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
              </div>

           </div>
            <div class="row mt-5">
                <div class="col">
                  <table class="table"  id="mytable">
                    <thead>
                      <tr>
                      <th>Sr No.</th>
                      <th>Items</th>
                      <th>Qty</th>
                      <th>Unit Price</th>
                      <th>Price</th>
                      <th></th>
                      </tr>
                    </thead>

                    <tbody>
					<tr><td></td><td></td><td><div class="text-center"><button type="button" class="btn btn-primary" id="add">+</button></div><td><td></td><td></td></tr>
					<tr>
                <td></td>
                <td></td>
                <td>Total</td>
                <td></td>
                <td id="grandTotal">0</td><td></td>
                </tr>
              </tbody>
                  </table>


                </div>
              </div>

              <div class="text-center mt-5">
                <input type="submit" name="submit" />
              </div>
          </form>
    </div>
    </div>
  </div>



    <script type="text/javascript">

        $(function() {
            $( ".datepicker-1" ).datepicker({ dateFormat:"yy-mm-dd",});
         });

         var i = -1;
    $("#add").click(function() {
        i++;
        var newElement = '<tr id="row'+i+'"  ><td>'+(i+1)+'</td>';
		newElement += '<td><input type = "text" name="line_items['+i+'][item]"></td>';
		newElement += '<td><input data-line-id="'+i+'" class="changeable'+i+'" id = "qty'+i+'" type = "number" value="0" min="0" name="line_items['+i+'][qty]"></td>';
		newElement += '<td><input data-line-id="'+i+'" class="changeable'+i+'" id="price'+i+'" type = "number" value="0" min="0" name="line_items['+i+'][unit_price]"></td>';
		newElement += '<td class="total" id="total'+i+'">0</td><td><button id="'+i+'" type="button" class="btn_remove btn-danger">x</button></td></tr>';
        $('#mytable tr').eq(-2).before(newElement);
		//$("#mytable").append($(newElement));
		$(".changeable"+i).change(function(el) {
			let line = $(el.target).data("line-id");
			let price = $("#price"+line).val();
			let qty = $("#qty"+line).val();
			let total = price * qty;
			//console.log("abc: "+price+ "  "+ qty);
			$("#total"+line).html(total)
			updateTotal();
		});
    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
		//console.log(button_id);
        $("#row" + button_id).remove();
		updateTotal();
    });
	$("#submit").click(function(){
	var form = JSON.stringify($("#form").serialize());//document.getElementById("form")
		console.log(form);
	});
        function updateTotal(){
			let totals = $(".total").map(function(){
				return $(this).html();
			}).get();
			let grandTotal = totals.reduce(function(total,el){
				return parseFloat(total) + parseFloat(el);
			});
			console.log(grandTotal);
			$('#grandTotal').html(grandTotal);
		}
    </script>

</body>
</html>
