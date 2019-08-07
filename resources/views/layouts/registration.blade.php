<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link href="{{asset('vendor/web/css/register.css') }}" rel='stylesheet' type='text/css' />
</head>
<body>
	@yield('header')
	@yield('menubar')

	@yield('content')
	

	@yield('footer')
</body>
</html>