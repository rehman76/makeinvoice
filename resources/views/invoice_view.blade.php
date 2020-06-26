<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Created Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="jquery.printPage.js" type="text/javascript"></script>

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

    <div class="container">
        <h1 class="text-center my-4">Invoice Created</h1>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Total</th>
            <th class="text-center">Action</th>

        </tr>
        @foreach($results as $result)
        <tr>
            <td>{{$result['name']}}</td>
            <td>{{ $result['total']}}</td>

            <td class="text-center"><a href = "/makeinvoice/{{$result['id']}}" target="_blank" class="btn btn-primary text-light" role="button">View</a>
            </td>
        </tr>
        @endforeach
    </table>

    <iframe id="printPage" name="printPage" src="invoice.html" style="position:absolute;top:0px; left:0px;width:0px; height:0px;border:0px;overflow:none; z-index:-1"></iframe>

    </div>
    <script>
      $(document).ready(function() {
        $(".btnPrint").printPage();
      });
      </script>
</body>
</html>
