<!DOCTYPE html>
<html>
<body>

<h2>Basic HTML Table</h2>

<table style="width:100%">
  <tr>
    <th>Total</th>
  </tr>
  @foreach($invoice as $invoices)
  <tr>

    <td>
         {{ $invoices->total }}

    </td>


</tr>
@endforeach
</table>

</body>
</html>
