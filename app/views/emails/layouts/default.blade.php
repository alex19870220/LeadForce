<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	@yield('content')

	<p>Best regards,</p>
	<p>The {{ Config::get('app.appname') }} Team</p>
</body>
</html>