<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	*/

	'url' => "http://leadforce.loc",

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    */

   'appname' => 'FatBoy',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'EST',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, long string, otherwise these encrypted values will not
	| be safe. Make sure to change it before deploying any application!
	|
	*/

	'key' => 'RkouFKiXZEmz2kiPEONAkQrb1EmUVbU8',

	'cipher' => MCRYPT_RIJNDAEL_128,

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

    'providers' => [
        /* Laravel Base Providers */
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Auth\Reminders\ReminderServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Database\MigrationServiceProvider',
		'Illuminate\Database\SeedServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',
		'Illuminate\Log\LogServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Remote\RemoteServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Session\CommandsServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Workbench\WorkbenchServiceProvider',

		/* Additional Providers */
		'Acme\Providers\CpanelServiceProvider',					// cPanel
		'Cartalyst\Sentry\SentryServiceProvider',				// Sentry
		'DaveJamesMiller\Breadcrumbs\ServiceProvider',			// Breadcrumbs
		// 'Intervention\Image\ImageServiceProvider',				// Image and Image Cache
		'Laracasts\Commander\CommanderServiceProvider',			// Laracasts Commander
		'Laracasts\Flash\FlashServiceProvider',					// Laracasts Flash
		'Pingpong\Widget\WidgetServiceProvider',				// Widget
		'Roumen\Sitemap\SitemapServiceProvider',				// Sitemap

		/* Brandon Johnson */
		'Acme\Piwik\PiwikStatsServiceProvider',					// PiwikStats
		'Acme\Piwik\PiwikTrackerServiceProvider',				// PiwikTracker
		'Acme\Providers\AdsenseHelperServiceProvider', 			// AdsenseHelper
		'Acme\Providers\CacheTagsServiceProvider', 				// CacheTags
		'Acme\Providers\ContentHandlerServiceProvider', 		// ContentHandler
		'Acme\Providers\EventServiceProvider', 					// Event Listener
		'Acme\Providers\ImageHelperServiceProvider',			// ImageHelper
		'Acme\Providers\LeadgenFormHelperServiceProvider',		// LeadgenFormHelper
		'Acme\Providers\PageListerServiceProvider',				// PageLister
		'Acme\Providers\ProjectActionsServiceProvider',			// ProjectActions
		'Acme\Providers\RepositoryServiceProvider', 			// Repositories (multiple)
		'Acme\Providers\SEOstatsServiceProvider',				// SEOstats
		'Acme\Providers\ShortcodeServiceProvider', 				// Shortcode
		'Acme\Providers\ShortcodesServiceProvider', 			// Shortcodes
		'Acme\Providers\ShutterProxyServiceProvider', 			// ShutterProxy
		'Acme\Providers\SpinnerServiceProvider', 				// Spinner
		'Acme\Providers\StatsUpdaterServiceProvider',			// StatsUpdater
		'Acme\Providers\WordAIServiceProvider',					// WordAI
		// 'Acme\Monetization\EmailOptins\EmailOptinServiceProvider',

		/* Uncomment for use in development */
		'Way\Generators\GeneratorsServiceProvider',				// Generators
		'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',	// IDE Helpers

    ],

    /*
    |--------------------------------------------------------------------------
    | Service Provider Manifest
    |--------------------------------------------------------------------------
    |
    | The service provider manifest is used by Laravel to lazy load service
    | providers which are not needed for each request, as well to keep a
    | list of all of the services. Here, you may set its storage spot.
    |
    */

    'manifest' => storage_path() . '/meta',

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [
        /* Laravel Base Aliases */
		'App'             => 'Illuminate\Support\Facades\App',
		'Artisan'         => 'Illuminate\Support\Facades\Artisan',
		'Auth'            => 'Illuminate\Support\Facades\Auth',
		'Blade'           => 'Illuminate\Support\Facades\Blade',
		'Cache'           => 'Illuminate\Support\Facades\Cache',
		'ClassLoader'     => 'Illuminate\Support\ClassLoader',
		'Config'          => 'Illuminate\Support\Facades\Config',
		'Controller'      => 'Illuminate\Routing\Controller',
		'Cookie'          => 'Illuminate\Support\Facades\Cookie',
		'Crypt'           => 'Illuminate\Support\Facades\Crypt',
		'DB'              => 'Illuminate\Support\Facades\DB',
		'Eloquent'        => 'Illuminate\Database\Eloquent\Model',
		'Event'           => 'Illuminate\Support\Facades\Event',
		'File'            => 'Illuminate\Support\Facades\File',
		'Form'            => 'Illuminate\Support\Facades\Form',
		'Hash'            => 'Illuminate\Support\Facades\Hash',
		'HTML'            => 'Illuminate\Support\Facades\HTML',
		'Input'           => 'Illuminate\Support\Facades\Input',
		'Lang'            => 'Illuminate\Support\Facades\Lang',
		'Log'             => 'Illuminate\Support\Facades\Log',
		'Mail'            => 'Illuminate\Support\Facades\Mail',
		'Paginator'       => 'Illuminate\Support\Facades\Paginator',
		'Password'        => 'Illuminate\Support\Facades\Password',
		'Queue'           => 'Illuminate\Support\Facades\Queue',
		'Redirect'        => 'Illuminate\Support\Facades\Redirect',
		'Redis'           => 'Illuminate\Support\Facades\Redis',
		'Request'         => 'Illuminate\Support\Facades\Request',
		'Response'        => 'Illuminate\Support\Facades\Response',
		'Route'           => 'Illuminate\Support\Facades\Route',
		'Schema'          => 'Illuminate\Support\Facades\Schema',
		'Seeder'          => 'Illuminate\Database\Seeder',
		'Session'         => 'Illuminate\Support\Facades\Session',
		'SSH'             => 'Illuminate\Support\Facades\SSH',
		'Str'             => 'Illuminate\Support\Str',
		'URL'             => 'Illuminate\Support\Facades\URL',
		'Validator'       => 'Illuminate\Support\Facades\Validator',
		'View'            => 'Illuminate\Support\Facades\View',

		/* Additional Aliases */
		'Breadcrumbs'     => 'DaveJamesMiller\Breadcrumbs\Facade',						// Breadcrumbs
		'Carbon'          => 'Carbon\Carbon',											// Carbon
		'Clockwork'       => 'Clockwork\Support\Laravel\Facade',						// Clockwork
		'Cpanel'          => 'Acme\Server\Facades\Cpanel',								// cPanel
		'Flash'           => 'Laracasts\Flash\Flash',									// Laracasts Flash
		// 'Image'           => 'Intervention\Image\Facades\Image',						// Image and Image Cache
		'Sentry'          => 'Cartalyst\Sentry\Facades\Laravel\Sentry',					// Sentry
		'Sitemap'         => 'Roumen\Sitemap\SitemapServiceProvider',					// Sitemap
		'Widget'          => 'Pingpong\Widget\Facades\Widget',							// Widget

		/* Brandon Johnson */
		'AdsenseHelper'     => 'Acme\Monetization\Adsense\Facades\AdsenseHelper',		// AdsenseHelper
		'CacheTags'         => 'Acme\Content\Facades\CacheTags',						// CacheTags
		'ContentHandler'    => 'Acme\Content\Facades\ContentHandler',					// ContentHandler
		'ImageHelper'       => 'Acme\Images\Facades\ImageHelper',						// ImageHelper
		'LeadgenFormHelper' => 'Acme\Monetization\Leadgen\Facades\LeadgenFormHelper',	// LeadgenFormHelper
		'PiwikStats'        => 'Acme\Piwik\Facades\PiwikStats',							// PiwikStats
		'PiwikTracker'      => 'Acme\Piwik\Facades\PiwikTracker',						// PiwikTracker
		'ProjectActions'    => 'Acme\Projects\Facades\ProjectActions',					// ProjectActions
		'SEOstats'          => 'SEOstats\SEOstats',										// SEOstats
		'Shortcode'         => 'Acme\Content\Shortcode\Facades\Shortcode',				// Shortcodes
		'Shortcodes'        => 'Acme\Content\Facades\Shortcodes',						// Shortcodes
		'ShutterProxy'      => 'Acme\Scraper\Facades\ShutterProxy',						// ShutterProxy
		'Spinner'           => 'Acme\Content\Spinner\Facades\Spinner',					// Spinner
		'StatsUpdater'      => 'Acme\Piwik\Facades\PiwikTracker',						// PiwikTracker
		'StatsUpdater'      => 'Acme\ProjectStats\Stats\Facades\StatsUpdater',			// StatsUpdater

    ],

    'available_language' => ['en', 'pt', 'es'],

];