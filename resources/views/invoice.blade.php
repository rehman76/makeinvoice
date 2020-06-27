
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
      table, th, td {
  border: 1px solid black;
}
.p{
    list-style-type: none;
    text-decoration: underline;
    display: inline-block;
    padding-left:10px
}
@media print{
    .bt{
        display: none;
    }
}
    </style>

</head>
<body>

<div class="container">
<h2 class="mt-4 text-danger">{{$vendor->name}}</h2>
  <div style="border: 1px solid black; margin-bottom: 10px;"></div>
  <div class="row my-4">
      <div class="col-4">
  <h6>Customer Name:<li class="p">Pantera Energy</li></h6>
  </div>
  <div class="col-4">
  <h6>Date:<li class="p">{{$masterInvoice->date}}</li></h6>
  </div>
  <div class="col-4 text-right">
        <button type="button" class="btn btn-primary bt" onclick="window.print()">Print</button>
  </div>
  </div>
  <table class="table bdr">
    <thead>
      <tr class="bg-danger">
        <th>Sr#</th>
        <th>Items</th>
        <th>Qty</th>
        <th>Unit</th>
        <th>Total</th>
      </tr>
    </thead>
      <tr style="height: 150px;">
      <td>{{$invoiceLine->id}}</td>
      <td>{{$invoiceLine->item}}</td>
      <td>{{$invoiceLine->quantity}}</td>
      <td>{{$invoiceLine->unit_price}}</td>
      <td>{{$invoiceLine->sub_total}}</td>
      </tr>

   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td>{{$invoice->total}}</td>
  </table>
<h5 class="text-center bg-danger py-2">{{$vendor->address}}</h5>
</div>

</body>
</html>
