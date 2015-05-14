<?php
// Show all SQL queries
if(1 == 2){
	Event::listen('illuminate.query', function($query)
	{
		var_dump($query);
	});
}

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group(['prefix' => 'auth'], function()
{
	# Login
	Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', 'AuthController@postLogin');

	# Register
	Route::get('register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
	Route::post('register', 'AuthController@postRegister');

	# Account Activation
	Route::get('activate/{activationCode}', ['as' => 'activate', 'uses' => 'AuthController@getActivate']);

	# Forgot Password
	Route::get('forgot-password', ['as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword']);
	Route::post('forgot-password', 'AuthController@postForgotPassword');

	# Forgot Password Confirmation
	Route::get('forgot-password/{passwordResetCode}', ['as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm']);
	Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

	# Logout
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
});

/*
|--------------------------------------------------------------------------
| Admin Backend
|--------------------------------------------------------------------------
|
|
*/

# Admin NameSpace
Route::group(['domain' => Config::get('app.url') . '.' . get_tld()], function()
{

	# App Root Domain
	Route::get('/', ['as' => 'home', 'uses' => 'DashboardController@getHome']);

	// Admin auth
	Route::group(['prefix' => 'admin', 'before' => 'admin-auth'], function()
	{
		# App Dashboard
		Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@getIndex']);

		/*
		|---------------------------
		| Projects
		|---------------------------
		|
		|
		*/
		Route::group(['prefix' => 'projects'], function()
		{
			# Projects Dashboard
			Route::get('/', ['as' => 'projects', 'uses' => 'ProjectsController@getIndex']);
			# Create Project
			Route::get('create', ['as' => 'create/project', 'uses' => 'ProjectsController@getCreate']);
			Route::post('create', 'ProjectsController@postCreate');
			# Edit Project
			Route::get('{projectId}/edit', ['as' => 'edit/project', 'uses' => 'ProjectsController@getEdit']);
			Route::post('{projectId}/edit', 'ProjectsController@postEdit');
			# Delete/Restore
			Route::get('{projectId}/delete', ['as' => 'delete/project', 'uses' => 'ProjectsController@getDelete']);
			Route::get('{projectId}/restore', ['as' => 'restore/project', 'uses' => 'ProjectsController@getRestore']);
			# Stats Dashboard
			Route::get('stats', ['as' => 'projects/stats', 'uses' => 'ProjectsController@getStatsPage']);

			# Create Piwik Sites
			Route::get('create-piwik-sites', ['as' => 'project/create-piwik-sites', 'uses' => 'ProjectsController@getCreatePiwikSites']);
			# Clear Project Cache
			Route::get('{id}/clear-cache', ['as' => 'project/clear-cache', 'uses' => 'ProjectsController@getClearCache']);
			# Clear Errors
			Route::get('{id}/clear-errors', ['as' => 'project/clear-errors', 'uses' => 'ProjectsController@getClearErrors']);
			# Calculate Niche stats
			Route::get('{id}/calculate-niche-stats', ['as' => 'project/calculate-niche-stats', 'uses' => 'ProjectsController@getCalculateNicheStats']);

			# Get Projects table
			Route::post('projects-table', ['as' => 'projects/projects-table', 'uses' => 'ProjectsController@postShowProjectTable']);

			# Update Project data [FOR BRANDON'S USE ONLY -- DANGEROUS SHIT!!]
			// Route::get('update-the-fucking-projects-holy-jesus-christ', 'ProjectsController@getUpdateFuckingProjectsJesusChrist');
		});

		/*
		|---------------------------
		| Project Categories
		|---------------------------
		|
		|
		*/
		Route::group(['prefix' => 'categories'], function()
		{
			Route::get('/', ['as' => 'categories', 'uses' => 'ProjectCategoriesController@getCategories']);
			Route::post('create-category', ['as' => 'categories/create', 'uses' => 'ProjectCategoriesController@postCreateCategory']);
			# Edit
			Route::get('{id}/edit', ['as' => 'categories/edit', 'uses' => 'ProjectCategoriesController@getEditCategory']);
			Route::post('{id}/edit', 'ProjectCategoriesController@postEditCategory');
			# Delete/Restore
			Route::get('{id}/delete', ['as' => 'categories/delete', 'uses' => 'ProjectCategoriesController@getDeleteCategory']);

			# Bulk Updates
			Route::get('bulk-updates', ['as' => 'categories/bulk-updates', 'uses' => 'ProjectCategoriesController@getCategories']);
		});

		/*
		|---------------------------
		| Pages
		|---------------------------
		|
		|
		*/
		Route::group(['prefix' => 'pages'], function()
		{
			# Dashboard
			Route::get('/', ['as' => 'pages', 'uses' => 'PagesController@getIndex']);
			# Create
			Route::get('create', ['as' => 'create/page', 'uses' => 'PagesController@getCreate']);
			Route::post('create', 'PagesController@postCreate');
			# Edit
			Route::get('{pageId}/edit', ['as' => 'edit/page', 'uses' => 'PagesController@getEdit']);
			Route::post('{pageId}/edit', 'PagesController@postEdit');
			# Delete/Restore
			Route::get('{pageId}/delete', ['as' => 'delete/page', 'uses' => 'PagesController@getDelete']);
			Route::get('{pageId}/restore', ['as' => 'restore/page', 'uses' => 'PagesController@getRestore']);
		});

		/*
		|---------------------------
		| Niches
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'niches'], function()
		{
			# Niche Dashboard
			Route::get('/', ['as' => 'niches', 'uses' => 'NichesController@getIndex']);
			# Create Niche
			Route::get('create', ['as' => 'create/niche', 'uses' => 'NichesController@getCreate']);
			Route::post('create', 'NichesController@postCreate');
			# Edit Niche
			Route::get('{nicheId}/edit', ['as' => 'edit/niche', 'uses' => 'NichesController@getEdit']);
			Route::post('{nicheId}/edit', 'NichesController@postEdit');
			# Delete/Restore
			Route::get('{id}/delete', ['as' => 'delete/niche', 'uses' => 'NichesController@getDelete']);
			Route::get('{id}/restore', ['as' => 'restore/niche', 'uses' => 'NichesController@getRestore']);

			# Clear Cache
			Route::get('{id}/clear-cache', ['as' => 'niche/clear-cache', 'uses' => 'NichesController@getClearCache']);
		});

		/*
		|---------------------------
		| Appearance
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'appearance'], function()
		{
			# Widgets
			Route::group(['prefix' => 'widgets'], function()
			{
				Route::get('/', ['as' => 'widgets', 'uses' => 'SidebarWidgetController@getWidgetsIndex']);
				Route::post('/', ['as' => 'widgets/create', 'uses' => 'SidebarWidgetController@postWidgetsIndex']);
				# Widgets - Edit
				Route::get('{id}/edit', ['as' => 'widgets/edit', 'uses' => 'SidebarWidgetController@getEditWidget']);
				Route::post('{id}/edit', ['uses' => 'SidebarWidgetController@postEditWidget']);
				# Widgets - Delete
				Route::get('{id}/delete', ['as' => 'widgets/delete', 'uses' => 'SidebarWidgetController@getDeleteWidget']);
			});

			# Sidebars
			Route::group(['prefix' => 'sidebars'], function()
			{
				Route::get('/', ['as' => 'sidebars', 'uses' => 'SidebarController@getSidebarsIndex']);
				# Sidebars - Create
				Route::post('create-sidebar', ['as' => 'sidebars/create-sidebar', 'uses' => 'SidebarController@postSidebarsIndex']);
				# Sidebars - Edit
				Route::get('{id}/edit', ['as' => 'sidebars/edit', 'uses' => 'SidebarController@getEditSidebar']);
				Route::post('{id}/edit', ['uses' => 'SidebarController@postEditSidebar']);
				# Sidebars - Delete
				Route::get('{id}/delete', ['as' => 'sidebars/delete', 'uses' => 'SidebarController@getDeleteSidebar']);
				# Add Widget to Sidebar
				Route::post('add-widget', ['as' => 'sidebars/add-widget', 'uses' => 'SidebarController@postAddWidgetToSidebar']);
			});

			# Images
			Route::group(['prefix' => 'images'], function()
			{
				Route::get('/', ['as' => 'images', 'uses' => 'ImagesController@getImagesIndex']);
				Route::post('/', ['as' => 'images/create', 'uses' => 'ImagesController@postUploadImage']);
				# Images - Edit
				Route::get('{id}/edit', ['as' => 'images/edit', 'uses' => 'ImagesController@getEditImage']);
				Route::post('{id}/edit', ['uses' => 'ImagesController@postEditImage']);
				# Images - Delete
				Route::get('{id}/delete', ['as' => 'images/delete', 'uses' => 'ImagesController@getDeleteImage']);
			});
		});

		/*
		|---------------------------
		| Monetizations
		|---------------------------
		|
		|
		*/
		Route::group(['prefix' => 'monetization'], function()
		{
			# Adsense
			Route::group(['prefix' => 'adsense'], function()
			{
				Route::get('/', ['as' => 'adsense', 'uses' => 'AdsenseController@getIndex']);
				Route::post('create', ['as' => 'adsense/update-adsense', 'uses' => 'AdsenseController@postCreateAdsense']);
			});

			# Affiliate Offers
			Route::group(['prefix' => 'affiliate-offers'], function()
			{
				Route::get('/', ['as' => 'affiliate-offers', 'uses' => 'AffiliateOffersController@getIndex']);
			});

			# Cloaking
			Route::group(['prefix' => 'cloaking'], function()
			{
				Route::get('/', ['as' => 'cloaking', 'uses' => 'CloakingController@getIndex']);
			});

			# Email Optins
			Route::group(['prefix' => 'email-optins'], function()
			{
				Route::get('/', ['as' => 'email-optins', 'uses' => 'EmailOptinController@getIndex']);
				# Create
				Route::post('create', ['as' => 'create/email-optin', 'uses' => 'EmailOptinController@postCreate']);
				# Edit
				Route::get('{id}/edit', ['as' => 'edit/email-optin', 'uses' => 'EmailOptinController@getEdit']);
				Route::post('{id}/edit', ['uses' => 'EmailOptinController@postEdit']);
				# Delete
				Route::get('{id}/delete', ['as' => 'delete/email-optin', 'uses' => 'EmailOptinController@getDelete']);
			});

			# HomeAdvisor
			Route::group(['prefix' => 'homeadvisor'], function()
			{
				Route::get('/', ['as' => 'homeadvisor', 'uses' => 'HomeAdvisorController@getIndex']);
				# Add URL's
				Route::post('add-urls', ['as' => 'homeadvisor/add-urls', 'uses' => 'HomeAdvisorController@postAddUrls']);
			});

			# Lead Generation
			Route::group(['prefix' => 'leadgen-forms'], function()
			{
				Route::get('/', ['as' => 'leadgen-forms', 'uses' => 'LeadgenController@getIndex']);
				# Create
				Route::post('create', ['as' => 'create/leadgen-form', 'uses' => 'LeadgenController@postCreate']);
				# Edit
				Route::get('{id}/edit', ['as' => 'edit/leadgen-form', 'uses' => 'LeadgenController@getEdit']);
				Route::post('{id}/edit', ['uses' => 'LeadgenController@postEdit']);
				# Delete
				Route::get('{id}/delete', ['as' => 'delete/leadgen-form', 'uses' => 'LeadgenController@getDelete']);
				# Preview Form
				Route::get('{id}/preview', ['as' => 'preview/leadgen-form', 'uses' => 'LeadgenController@getPreviewForm']);
			});

		});

		/*
		|---------------------------
		| Indexer
		|---------------------------
		|
		|
		*/

		# Indexer Management
		Route::group(['prefix' => 'indexer'], function()
		{
			# Dashboard
			Route::get('/', ['as' => 'indexer', 'uses' => 'IndexerController@getDashboard']);
			Route::post('/', ['uses' => 'IndexerController@store']);
			# Update Status

			# Settings
			Route::get('settings', ['as' => 'indexer/settings', 'uses' => 'IndexerController@getSettings']);
			# Edit
			Route::get('{id}/edit', ['as' => 'update/indexer', 'uses' => 'IndexerController@getEdit']);
			Route::post('{id}/edit', 'IndexersController@postEdit');
			# Delete
			Route::get('{id}/delete', ['as' => 'delete/indexer', 'uses' => 'IndexerController@getDelete']);

			# Start/Stop Indexer
			Route::post('{id}/start', ['as' => 'indexer/start', 'uses' => 'IndexerController@postStartIndexing']);
			Route::post('{id}/stop', ['as' => 'indexer/stop', 'uses' => 'IndexerController@postStopIndexing']);

			# Scrape Videos
			Route::get('{id}/scrape-videos', ['as' => 'indexer/scrape-videos', 'uses' => 'IndexerController@getStartScraping']);
			# Rebuild sitemap
			Route::get('{id}/rebuild-sitemap', ['as' => 'indexer/rebuild-sitemap', 'uses' => 'IndexerController@getRebuildSitemap']);
			# Generate URL/Video list, build Cache, and generate Sitemaps
			Route::get('{id}/rebuild-video-sitemap', ['as' => 'indexer/rebuild-video-sitemap', 'uses' => 'IndexerController@getRebuildVideoSitemap']);
			# Ping Sitemaps to Search Engines
			Route::get('{id}/ping-sitemap', ['as' => 'indexer/ping-sitemap', 'uses' => 'IndexerController@getPingSitemap']);
			# Submit Project URLs to IndexerServices
			Route::get('{id}/submit-to-indexer-service', ['as' => 'indexer/get-indexer-services', 'uses' => 'IndexerController@getSubmitLinksToIndexerService']);
			Route::post('{id}/submit-to-indexer-service', ['as' => 'indexer/post-indexer-services', 'uses' => 'IndexerController@postSubmitLinksToIndexerService']);

			# Update Index Counts
			Route::get('update-index-count', ['as' => 'indexer/update-index-count', 'uses' => 'IndexerController@getUpdateProjectStats']);
		});

		/*
		|---------------------------
		| Users & Groups
		|---------------------------
		|
		|
		*/

		# User Management
		Route::group(['prefix' => 'users'], function()
		{
			# Dashboard
			Route::get('/', ['as' => 'users', 'uses' => 'UsersController@getIndex']);
			# Create
			Route::get('create', ['as' => 'create/user', 'uses' => 'UsersController@getCreate']);
			Route::post('create', 'UsersController@postCreate');
			# Edit
			Route::get('{userId}/edit', ['as' => 'update/user', 'uses' => 'UsersController@getEdit']);
			Route::post('{userId}/edit', 'UsersController@postEdit');
			# Delete/Restore
			Route::get('{userId}/delete', ['as' => 'delete/user', 'uses' => 'UsersController@getDelete']);
			Route::get('{userId}/restore', ['as' => 'restore/user', 'uses' => 'UsersController@getRestore']);
		});

		# Group Management
		Route::group(['prefix' => 'groups'], function()
		{
			# Dashboard
			Route::get('/', ['as' => 'groups', 'uses' => 'GroupsController@getIndex']);
			# Create
			Route::get('create', ['as' => 'create/group', 'uses' => 'GroupsController@getCreate']);
			Route::post('create', 'GroupsController@postCreate');
			# Edit
			Route::get('{groupId}/edit', ['as' => 'update/group', 'uses' => 'GroupsController@getEdit']);
			Route::post('{groupId}/edit', 'GroupsController@postEdit');
			# Delete/Restore
			Route::get('{groupId}/delete', ['as' => 'delete/group', 'uses' => 'GroupsController@getDelete']);
			Route::get('{groupId}/restore', ['as' => 'restore/group', 'uses' => 'GroupsController@getRestore']);
		});

		/*
		|---------------------------
		| Settings
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'settings'], function()
		{
			# Geolocation Settings
			Route::get('geolocation', ['as' => 'geolocation', 'uses' => 'GeoController@getIndex']);
			Route::post('geolocation', ['as' => 'geolocation/import-geolocation-db', 'uses' => 'GeoController@postImportGeoLocationDB']);
			Route::post('geolocation-city-letters', ['as' => 'geolocation-city-letters', 'uses' => 'GeoController@postCityLetters']);
			Route::post('geolocation-city-population', ['as' => 'geolocation-city-population', 'uses' => 'GeoController@postCityPopulation']);

			# Proxy Settings
			Route::group(['prefix' => 'proxies'], function()
			{
				Route::get('/', ['as' => 'proxies', 'uses' => 'ProxyController@getIndex']);
				Route::post('/', 'ProxyController@postIndex');
				# Clear All Proxies
				Route::get('clear-all', ['as' => 'proxies/clear-all', 'uses' => 'ProxyController@getClearAllProxies']);
			});

			# Spintax
			Route::group(['prefix' => 'spintax'], function()
			{
				Route::get('/', ['as' => 'spintax', 'uses' => 'SpintaxController@getIndex']);
				Route::get('recompile-headers', ['as' => 'spintax/recompile-headers', 'uses' => 'SpintaxController@getRecompileHeaders']);
			});
		});

		/*
		|---------------------------
		| System
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'system'], function()
		{
			# Queue Settings
			Route::group(['prefix' => 'queue'], function()
			{
				# Dashboard
				Route::get('/', ['as' => 'queues', 'uses' => 'QueueManagerController@getDashboard']);
				# Queue Job Count
				Route::get('job-count', ['as' => 'queues/job-count', 'uses' => 'QueueManagerController@getQueueJobCount']);
			});

			# Cache Settings
			Route::get('cache', ['as' => 'cache', 'uses' => 'CacheController@getIndex']);
			Route::post('cache', 'CacheController@postUpdate');

			# Bulk Updates
			Route::group(['prefix' => 'bulk'], function()
			{
				Route::get('project-updater', ['as' => 'bulk/project-updater', 'uses' => 'BulkUpdatesController@getProjectUpdater']);
				Route::get('project-updater-process', ['as' => 'bulk/project-updater/process', 'uses' => 'BulkUpdatesController@getProjectUpdaterProcess']);
			});
		});

		/*
		|---------------------------
		| Account / Profile
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'account'], function()
		{
			# Account Dashboard
			Route::get('/', ['as' => 'account/dashboard', 'uses' => 'AccountController@getIndex']);

			# Settings
			Route::get('settings', ['as' => 'account/settings', 'uses' => 'AccountController@getSettings']);
			# Update Indexer API's
			Route::post('settings/update-indexer-apis', ['as' => 'account/settings/update-indexer-apis', 'uses' => 'AccountController@postUpdateIndexerAPIs']);
			# Update Adsense
			Route::post('settings/update-adsense', 'AdsenseController@postUpdateAdsense');

			# Profile
			Route::get('profile', ['as' => 'account/profile', 'uses' => 'ProfileController@getUpdateProfile']);
			Route::post('profile', 'ProfileController@postUpdateProfile');

			# Notifications
			Route::get('notifications', ['as' => 'account/notifications', 'uses' => 'NotificationController@getIndex']);
			Route::post('notifications', 'NotificationController@postIndex');

			# Support
			Route::get('support', ['as' => 'account/support', 'uses' => 'AccountController@getSupport']);
			Route::post('support', 'AccountController@postSupport');

			# Change Password
			Route::get('change-password', ['as' => 'account/change-password', 'uses' => 'ChangePasswordController@getIndex']);
			Route::post('change-password', 'ChangePasswordController@postIndex');

			# Change Email
			Route::get('change-email', ['as' => 'account/change-email', 'uses' => 'ChangeEmailController@getIndex']);
			Route::post('change-email', 'ChangeEmailController@postIndex');
		});

		/*
		|---------------------------
		| Tools
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'tools'], function()
		{
			# Keyword Grouper
			Route::get('keyword-grouper', ['as' => 'tools/keyword-grouper', 'uses' => 'ToolsController@getKeywordGrouper']);
			Route::post('keyword-grouper', 'ToolsController@postKeywordGrouper');
			# Keyword Multiplier
			Route::get('keyword-multiplier', ['as' => 'tools/keyword-multiplier', 'uses' => 'ToolsController@getKeywordMultiplier']);
			Route::post('keyword-multiplier', 'ToolsController@postKeywordMultiplier');
		});

		/*
		|---------------------------
		| Social Network
		|---------------------------
		|
		|
		*/

		# View User
		Route::get('@{username}', ['as' => 'user/profile', 'uses' => 'ProfileController@getViewUsername']);
		# Follow / Unfollow User
		Route::get('follows/{id}', ['as' => 'user/follows-button', 'uses' => 'FollowsController@getFollowsButton']);
		Route::post('follows/{id}', ['as' => 'user/follows', 'uses' => 'FollowsController@postUserFollows']);

		# Statuses
		Route::post('update-status', ['as' => 'social/update-status', 'uses' => 'StatusController@postNewStatus']);
		# Status - Reply
		Route::post('reply-status', ['as' => 'social/reply-status', 'uses' => 'StatusController@postReplyToStatus']);

		Route::group(['prefix' => 'user'], function()
		{

		});

		/*
		|---------------------------
		| Ajax
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'ajax'], function()
		{
			Route::get('piwik-stats/{id}', ['as' => 'ajax/piwik-stats', 'uses' => 'AjaxController@getPiwikStats']);
		});

		/*
		|---------------------------
		| Modals / Popups
		|---------------------------
		|
		|
		*/

		Route::group(['prefix' => 'modal'], function()
		{
			Route::get('shortcode-info', ['as' => 'modal/shortcode-info', 'uses' => 'DashboardController@getModalShortcodes']);
		});

	});// End Controllers\Admin\ Namespace

}); // End Admin Domain

/*
|--------------------------------------------------------------------------
| Frontend - View Project
|--------------------------------------------------------------------------
|
|
|
*/

# Controllers Namespace
Route::group(['domain' => '{projectSlug}.{tld}'], function($projectSlug)
{

	// Browser caching the pages for visitors
	Route::group(['after' => 'cache-browser'], function($projectSlug)
	{
		/*
		|---------------------------
		| Frontend Pages
		|---------------------------
		|
		*/

		# Project Home
		Route::get('/', ['as' => 'project/home', 'uses' => 'ViewProjectController@getProjectHome']);

		# About Us
		Route::get('about-us', ['as' => 'project/about-us', 'uses' => 'ViewProjectController@getAboutUs']);

		# Contact Us
		Route::get('contact-us', ['as' => 'project/contact-us', 'uses' => 'ViewProjectController@getContactUs']);

		# Cloaker Blank Page
		Route::get('page-loader', ['as' => 'project/page-loader', 'uses' => 'ViewProjectController@getBlankPage']);

		## Search Locations
		Route::get('search', ['as' => 'search/location', 'uses' => 'SearchController@getSearchLocation']);
		Route::post('search', ['as' => 'search/location', 'uses' => 'SearchController@postSearchLocation']);

		// # Legal Pages
		Route::group(['prefix' => 'legal'], function()
		{
			# Privacy policy
			Route::get('privacy', ['as' => 'project/privacy', 'uses' => 'ViewProjectController@getPrivacy']);

			# Terms of service
			Route::get('tos', ['as' => 'project/tos', 'uses' => 'ViewProjectController@getTOS']);

			# Disclaimer
			Route::get('disclaimer', ['as' => 'project/disclaimer', 'uses' => 'ViewProjectController@getDisclaimer']);

			# Earnings Disclaimer
			Route::get('earnings-disclaimer', ['as' => 'project/earnings-disclaimer', 'uses' => 'ViewProjectController@getEarningsDisclaimer']);
		});

		/*
		|---------------------------
		| Geolocation & Niche Pages
		|---------------------------
		|
		*/

		# Directory
		Route::get('directory', ['as' => 'browse/states', 'uses' => 'ViewProjectController@getDirectory']);
		# View State
		Route::get('{st}', ['as' => 'project/state', 'uses' => 'ViewProjectController@getViewState']);
		# View State/Letter
		Route::get('{st}/page/{cityLetter}', ['as' => 'project/state/letter', 'uses' => 'ViewProjectController@getViewStateCityLetter']);
		# View City
		Route::get('{st}/{city}', ['as' => 'project/city', 'uses' => 'ViewProjectController@getViewCity']);
		# View Niche Page
		Route::get('{st}/{city}/{nicheSlug}', ['as' => 'project/niche', 'uses' => 'ViewProjectController@getViewNiche']);

		// # Directory
		// Route::get('directory', ['as' => 'browse/states', 'uses' => 'ViewProjectController@getDirectory']);
		// # View State
		// Route::get('{st}.html', ['as' => 'project/state', 'uses' => 'ViewProjectController@getViewState']);
		// # View State/Letter
		// Route::get('{st}-page-{cityLetter}.html', ['as' => 'project/state/letter', 'uses' => 'ViewProjectController@getViewStateCityLetter']);
		// # View City
		// Route::get('{st}-{city}.html', ['as' => 'project/city', 'uses' => 'ViewProjectController@getViewCity']);
		// # View Niche Page
		// Route::get('{st}-{city}-{nicheSlug}.html', ['as' => 'project/niche', 'uses' => 'ViewProjectController@getViewNiche']); // Doesn't work
		// Route::get('{st}-{city}/{nicheSlug}.html', ['as' => 'project/niche', 'uses' => 'ViewProjectController@getViewNiche']); // Works
		// // Route::get('{st}/{city}/{nicheSlug}', ['as' => 'project/niche', 'uses' => 'ViewProjectController@getViewNiche']);

		# Pages
		Route::get('{pageSlug}', ['as' => 'project/page', 'uses' => 'ViewProjectController@getPage']);
	});

	/*
	|---------------------------
	| Monetization
	|---------------------------
	|
	*/

	# Email Optin
	Route::post('subscribe', ['as' => 'monetization/subscribe', 'uses' => 'FrontendEmailOptinController@postEmailOptin']);

	/*
	|---------------------------
	| Sitemaps
	|---------------------------
	|
	*/

	# Video Sitemap - Index
	Route::get('sitemap-video-index.xml', ['as' => 'sitemap-video/index', 'uses' => 'SitemapController@getVideoSitemapIndex']);
	# Video Sitemap - Index
	Route::get('sitemap-video-{id}.xml', ['as' => 'sitemap-video/view-sitemap', 'uses' => 'SitemapController@getVideoSitemap']);
	# Sitemap Index
	Route::get('sitemap.xml', ['as' => 'sitemap/index', 'uses' => 'SitemapController@getSitemapIndex']);
	Route::get('sitemap-{sitemap}.xml', ['as' => 'sitemap/state-index', 'uses' => 'SitemapController@getSitemap']);

	/*
	|---------------------------
	| Assets
	|---------------------------
	|
	*/

	Route::get('robots.txt', ['as' => 'asset/robots.txt', 'uses' => 'AssetController@getRobotsTxt']);
	Route::get('piwik.js', ['as' => 'asset/piwik-js', 'uses' => 'PiwikController@getJS']);
	Route::get('piwik.php', ['as' => 'asset/piwik-proxy', 'uses' => 'PiwikController@getPiwikProxy']);
	// Route::get('piwik.gif', ['as' => 'asset/piwik-php', 'uses' => 'PiwikController@getPiwikProxy']);

}); // Projects

/*
|---------------------------
| Google Verification
|---------------------------
|
*/

Route::get('googled22231ecb0a9ae1b.html', function()
{
	return 'google-site-verification: googled22231ecb0a9ae1b.html';
});