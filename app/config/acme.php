<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Directory Paths & Options
	|--------------------------------------------------------------------------
	|
	| This is an array of paths leading to various scripts/files that FatBoy
	| relies on to do its thing.
	|
	*/

	'dir' => [

		'sitemap'			=> app_path() . '/storage/sitemaps',

		'images' => [
			'banners'		=> app_path() . '/storage/images/banners/',
			'logos'			=> app_path() . '/storage/images/logos/',
			'content'		=> app_path() . '/storage/images/content/',
		],

		'js' => [
			'jquery'		=> 'https://googledrive.com/host/0ByO3MIcASP_jdC1uTm1FYU44RDA/jquery-1.11.1.min.js',
		],

		'css' => [
			'stylesheets' => [
				'default'	=> '/templates/default/assets/css/styles.css',
			],
		],

		'fonts' => [
			'opensans'		=> ''
		],

		'iconfonts' => [
			'fontawesome' => [
			],
			'glyphicon' => [
			],
			'icon' => [
			],
		],
	],

	/*
	|--------------------------------------------------------------------------
	| URL's to Project Stuff
	|--------------------------------------------------------------------------
	|
	| Since we have to ghetto-rig URL's, here's some useful URL's
	|
	*/

	'urls' => [

		'sitemap'		=> '/sitemap.xml',
		'videositemap'	=> '/sitemap-video-index.xml',
	],

	/*
	|--------------------------------------------------------------------------
	| Page Calcuation Data & Options
	|--------------------------------------------------------------------------
	|
	| Here we'll set the base number of States/Cities/Counties/Etc used for
	| calculating the number of pages a project has.
	|
	*/

	'geo' => [
		'statecount'	=> 50,
		'countycount'	=> 3143,
		'citycount'		=> 50917,
		'defaultpages'	=> 8,
	],

	/*
	|--------------------------------------------------------------------------
	| Cache Tags & Times
	|--------------------------------------------------------------------------
	|
	| Set the base caching time for Geo Objects because they are very rarely
	| updated and this'll just safe a lot of hassle.
	|
	*/

	'cache' => [

		'content' => [
			'enabled'	=> true,
		],

		'adsense'		=> 120,
		'geo'			=> 770,		// Cache time for States/Cities... aka they never change, so make it big
		'images'		=> 60,
		'niche'			=> 60,
		'page'			=> 300,		// Pages don't update very often
		'piwik'			=> 1440,
		'piwikstats'	=> 30,
		'project'		=> 60,		// Projects change *kinda* often
		'shortcodes'	=> 90,
		// 'sidebars'		=> 30, // Actually dude... we preloaded them lawl
	],

	/*
	|--------------------------------------------------------------------------
	| Sitemap Options
	|--------------------------------------------------------------------------
	|
	| Different config settings for Sitemap generation
	|
	*/

	'sitemaps'		=> [

		'priorities'	=> [
			'page'		=> '0.5',
			'state'		=> '0.6',
			'city'		=> '0.8',
			'niche'		=> '0.9',
		],

		'perpage'	=> '2000',
	],

	/*
	|--------------------------------------------------------------------------
	| User API Lists & Options
	|--------------------------------------------------------------------------
	|
	| An array of the different types of APIs that a user can set in
	| his/her settings. This goes by a specific format
	|
	*/

	'api' => [

		'indexers' => [

			'instantlinkindexer' => [
				'name'   			  => 'Instant Link Indexer',
				'website'			  => 'http://www.instantlinkindexer.com/',
				'apiurl' 			  => 'http://www.instantlinkindexer.com/api.php',
			],

			'indexification' => [
				'name'   			  => 'Indexification',
				'website'			  => 'http://www.indexification.com/',
				'apiurl'  			 => 'http://www.indexification.com/api.php',
			],

			'linkprocessor' => [
				'name'    			 => 'Link Processor',
				'website' 			 => 'http://linkprocessor.com/',
				'apiurl'  			 => 'http://api.linkprocessor.net/api.php',
			],
		],

		'piwik'	=> [
			'token'				=> '089f27828868fc5be5321602223887b4',
			'url'				=> 'piwik.shuttertools.com',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Diplay Options
	|--------------------------------------------------------------------------
	|
	| Default numbers/letters/etc to display
	|
	*/

	'display' => [

		'empty' => [
			'number'			=> '--',	// acme.display.empty.number
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Monetization Options
	|--------------------------------------------------------------------------
	|
	| Options to make the monetizing FatBoy easy!
	|
	*/

	/**
	 * Lead Generation
	 */
	'leadgen' => [

		'lds' => [
			'name'				=> 'Instant Leads Generator',
			'form_action'		=> 'http://pdxsolution.com/lds/addlead.php',
			'form_hidden'		=> ['campaign', 'cvfid', 'exact'],
		],

	],

	/**
	 * Email Optins
	 */
	'emailoptins' => [

		'services' => [

			'mailchimp' =>	[
				'name'			=> 'MailChimp',
			],
			'icontact' => [
				'name'			=> 'iContact',
			],
			'aweber' => [
				'name'			=> 'AWeber',
			],
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Google & Proxy Settings
	|--------------------------------------------------------------------------
	|
	| Options to make sure Google doesn't hate us
	|
	*/

	/**
	 * Proxies
	 */
	'proxies' => [
		'timeout'				=> 30,
	],

];