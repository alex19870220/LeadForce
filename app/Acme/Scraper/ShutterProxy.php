<?php namespace Acme\Scraper;

use Config;
use Proxy;



use DB;

class ShutterProxy {

	/**
	 * @var Proxy $proxies
	 */
	public $proxies;

	/**
	 * @var integer $timeout
	 */
	public $timeout;

	/**
	 * Instantiate the object
	 */
	function __construct()
	{
		// Set Proxy timeout
		$this->timeout = Config::get('acme.proxies.timeout');

		// Get the Proxy list
		$this->proxies = $this->refreshProxies();
	}

	/**
	 * Grabs all Proxies in the database and returns them
	 *
	 * @return Proxy
	 */
	protected function refreshProxies()
	{
		$proxies = Proxy::active()->timeout($this->timeout)->get();

		$this->proxies = $proxies;

		return $this->proxies;
	}

	/**
	 * Returns a random proxy
	 *
	 * @return Proxy
	 */
	public function getProxy()
	{
		if(count($this->proxies) < 1)
			$this->proxies = $this->refreshProxies();

		// Grab random proxy
		$proxy = $this->proxies->random();

		if(! isset($proxy) || ! $proxy || count($this->proxies) == 0)
			return false;

		// Update proxy's last_used time & save
		$proxy->last_used = time();
		$proxy->save();

		return $proxy;
	}

	/**
	 * Grab all proxies that are active and return an array
	 *
	 * @return array $proxies
	 */
	public function listProxies()
	{
		// Return the array of proxies
		return $this->proxies->toArray();
	}

	/**
	 * Grab all proxies that are active and return an array
	 *
	 * @return array $proxies
	 */
	public function getProxies()
	{
		return $this->proxies->toArray();
	}
	
	/**
	 *!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	 */
	public function getProxyTimeout()
	{
		return $this->timeout;
	}
	/**
	 *!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	 */

	/**
	 * Updates a Proxy's stats after usage
	 *
	 * @param  string $ip
	 * @param  array $data
	 * @return bool
	 */
	public function updateProxyStats($ip, $data)
	{
		// Check if IP is set
		if(is_null($ip))
			return false;

		if($proxy = Proxy::whereIp($ip)->first())
		{
			$proxy->last_result		= $data['last_result'];
			$proxy->last_load_time	= $data['last_load_time'];
			$proxy->error_html		= $data['error_html'];

			if($proxy->save())
				return true;

			return false;
		}

		return false;
	}

}