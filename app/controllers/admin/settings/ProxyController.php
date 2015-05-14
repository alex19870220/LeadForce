<?php

class ProxyController extends AdminController {

	/**
	 * @var ProxyForm $proxyForm
	 */
	protected $proxyForm;

	/**
	 * Instantiate the Object
	 *
	 * @param AcmeFormsProxyForm $proxyForm
	 */
	function __construct(Acme\Forms\ProxyForm $proxyForm)
	{
		parent::__construct();

		$this->proxyForm = $proxyForm;
	}

	/**
	 * View the Proxy dashboard
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$proxies = Proxy::orderBy('last_used', 'DESC')->get();

		return View::make('backend.proxies.dashboard', compact('proxies'));
	}

	/**
	 * Add new proxies
	 *
	 * @return Response
	 */
	public function postIndex()
	{
		$proxies = explode(PHP_EOL, Input::get('proxies'));

		// Count the proxies added
		$i = 0;

		// Loop through the proxies
		foreach($proxies as $proxy)
		{
			// ip:port:username:password
			$proxy = explode(':', $proxy);

			// Get the current user
			$currentUser = Sentry::getId();

			// Check if proxy IP exists
			if(Proxy::whereIp($proxy[0])->count() == 0)
			{
				$newProxy = new Proxy;

				$newProxy->user_id		= $currentUser;
				$newProxy->ip			= e($proxy[0]);
				$newProxy->port			= e($proxy[1]);

				if(isset($proxy[2])) $newProxy->username		= e($proxy[2]);
				if(isset($proxy[3])) $newProxy->password		= e($proxy[3]);
				$newProxy->active		= true;

				if($newProxy->save())
				{
					$i++;
				}
			}
		}

		Flash::success("{$i} proxies uploaded successfully!");

		return Redirect::route('proxies');
	}

	/*
	|--------------------------------------------------------------------------
	| One-Click Actions
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Clear all Proxies
	 *
	 * @return Response
	 */
	public function getClearAllProxies()
	{
		// Clear all proxies
		DB::table('proxies')->truncate();

		Flash::success('All proxies have been deleted!');

		return Redirect::route('proxies');
	}

}