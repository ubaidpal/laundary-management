@php
$replace = [
    '&amp;' => '&', '&quot;' => '"', '&apos;' => "'", '&gt;' => '>', '&lt;' => '<', '&ldquo;' => '“', '&rdquo;' => '”'
];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ $data->title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>{{ $data->title}}</h1>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
        {!!  str_replace(array_keys($replace), array_values($replace),$data->description) !!}
    </div>
  </div>
</div>

</body>
</html>
