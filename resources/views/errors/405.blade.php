<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{asset('img/favicon.png')}}"
      type="image/x-icon"
    />
    <title>405 - Not Allowed</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404.gif') }}" title="error" />
        <p><span></span>Why are you here?</p>
        <a href="{{ url('/') }}">Back To Home</a>
    </div>
</body>
</html>