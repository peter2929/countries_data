<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Countries</title>
</head>
<body>

<form id="delete-countries-form"
      method="POST"
      action="/delete"
      style="display: none;">
    @csrf
    @method('DELETE')
</form>

<nav class="main-menu">
    <a href="/">Main</a>
    <a href="/import">Import</a>
    <a href="#" onclick="
       if(confirm('Delete all countries?')) {
           document.getElementById('delete-countries-form').submit();
       }
       return false;
   ">
    Delete
</a>
</nav>

@yield('content')

</body>
</html>