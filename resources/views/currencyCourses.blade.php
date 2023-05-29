<!DOCTYPE html>
<html>
<head>
    <title>Laravel Bootstrap Datepicker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>
<body>

<div class="container">
    <h1>Choose date: </h1>
    <form action= {{ route('currency') }}>
        @method('GET')
        @csrf
        <input name="date" class="date form-control" type="text">
        <button type="submit">Get courses</button>
    </form>
    <div>
        {{ $day === null ? 'Today' : $day}}
    </div>
    <table class="table mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">PLND</th>
            <th scope="col">EURO</th>
            <th scope="col">USD</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>1</td>
           <td>{{ $euro === null ? "data doesnt exist" : $euro }}</td>
            <td>{{ $usd === null ? "data doesnt exist" : $usd }}</td>
        </tr>
        </tbody>
    </table>
</div>



<script type="text/javascript">
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
</script>
</body>

</html>
