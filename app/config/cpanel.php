<?php

return [

	// should debugging statements be printed?
	'debug' => true,

	// The host to connect to (Eg: 127.0.0.1 or yourwebsite.com or whm.yourwebsite.com)
	'host' => $_ENV['cpanel.host'],

	// the port to connect to
	'port' => $_ENV['cpanel.port'],

	// should be the literal strings http or https
	'protocol' => 'https',

	// output that should be given by the cpanel api (xml or json)
	'output' => 'json',

	// literal strings hash or password
	'auth_type' => $_ENV['cpanel.auth_type'],

	//  the actual password or hash
	'auth' => $_ENV['cpanel.auth'],

	// username to authenticate as
	'user' => $_ENV['cpanel.user'],

	// The HTTP Client to use
	'http_client' => 'curl'

];