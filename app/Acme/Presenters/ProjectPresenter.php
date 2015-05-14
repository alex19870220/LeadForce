<?php namespace Acme\Presenters;

use Acme\Projects\ProjectTheme;
use Cache;
use Config;
use Laracasts\Presenter\Presenter;
use Request;
use Route;
use Spinner;
use URL;

class ProjectPresenter extends Presenter {

	/**
	 * Returns the URL path to the current Project's template directory
	 *
	 * @param  boolean $includeUrl
	 * @return string
	 */
	public function templateDirectory($includeUrl = false)
	{
		$dir = ($includeUrl == false) ? '' : $this->entity->website_url;

		return $dir . '/templates/' . $this->entity->template;
	}

	/**
	 * Returns the VIEW path to the current Project's template
	 *
	 * @return string
	 */
	public function templatePath()
	{
		$template = $this->entity->template;

		// Check if template is set
		if(! $this->entity->template) $template = 'default';

		return 'frontend.templates.'.strtolower($this->entity->template);
	}

	/**
	 * Removes \r\n\t from the page title
	 *
	 * @param  string $title
	 * @return string
	 */
	public function pageTitle($title = null)
	{
		return trimSpace(trim($title . ' ' . $this->entity->titleSeparator() . ' ' . $this->entity->website_title));
	}

	/*
	|--------------------------------------------------------------------------
	| URL's to Shit
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * URL to homepage
	 *
	 * @return string
	 */
	public function homeUrl()
	{
		return route('project/home', [$this->entity->slug, $this->entity->tld]);
	}

	/**
	 * URL to directory
	 *
	 * @return string
	 */
	public function directoryUrl()
	{
		return route('browse/states', [$this->entity->slug, $this->entity->tld]);
	}

	/**
	 * URL to contact page
	 *
	 * @return string
	 */
	public function contactPageUrl()
	{
		return route('project/contact-us', [$this->entity->slug, $this->entity->tld]);
	}

	/**
	 * URL to about us
	 *
	 * @return string
	 */
	public function aboutUsUrl()
	{
		return route('project/about-us', [$this->entity->slug, $this->entity->tld]);
	}

	/**
	 * URL to the Project's sitemap
	 *
	 * @return string
	 */
	public function urlToSitemap()
	{
		return $this->homeUrl . Config::get('acme.urls.sitemap');
	}

	/**
	 * URL to the Project's video sitemap
	 *
	 * @return string
	 */
	public function urlToVideoSitemap()
	{
		return $this->homeUrl . Config::get('acme.urls.videositemap');
	}

	/*
	|--------------------------------------------------------------------------
	| Theme Setup
	|--------------------------------------------------------------------------
	|
	|
	*/



	/*
	|--------------------------------------------------------------------------
	| Quick Checker Things
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Checks if a Proejct will work or not
	 *
	 * @return bool
	 */
	public function checkStatusIcon()
	{
		if(is_null($this->entity->niche))
			return false;

		if(empty($this->entity->niche->keyword_main) || empty($this->entity->niche->keywords))
			return false;

		if(is_null($this->entity->niche->children))
			return false;

		if($this->entity->hasErrors())
			return false;

		return true;
	}

	/**
	 * Check if there's a Piwik tracking ID
	 *
	 * @return bool
	 */
	public function piwikStatusIcon()
	{
		if(is_null($this->entity->tracking_id))
			return false;

		return true;
	}

	/**
	 * Check if a Monetization is being used, if so, display special icon
	 *
	 * @return string
	 */
	public function monetizationStatusIcon()
	{
		$monetizationType = $this->entity->getOption('monetization.type');

		if(empty($monetizationType) || $monetizationType == '')
			return false;

		switch ($monetizationType) :
			case 'affiliateoffer':
				$type = '<i class="fa fa-bullhorn text-success" ' . tooltip('Affiliate Offer') . '></i>';
				break;
			case 'cloaking':
				$type = '<i class="fa fa-rocket text-success" ' . tooltip('Cloaking') . '></i>';
				break;
			case 'emailoptin':
				$type = '<i class="fa fa-envelope-o text-success" ' . tooltip('Email Optin') . '></i>';
				break;
			case 'leadgen':
				$type = '<i class="fa fa-phone text-success" ' . tooltip('Leadgen') . '></i>';
				break;
			default:
				$type = '<i class="fa fa-exclamation-circle text-danger" ' . tooltip('No Monetization!') . '></i>';
				break;
		endswitch;

		if($monetizationType == 'cloaking' && ! $this->entity->getOption('monetization.cloaking.enabled'))
		{
			$type = str_replace(' text-success', '', $type);
			$type = str_replace('"Cloaking"', '"Cloaking - Off!"', $type);
		}

		return $type;

	}

	/**
	 * Check if there's an indexer campaign
	 *
	 * @return bool
	 */
	public function indexerStatusIcon()
	{
		if(is_null($this->entity->indexer))
			return false;

		return true;
	}

	/**
	 * Check if Adsense is enabled
	 *
	 * @return bool
	 */
	public function adsenseStatusIcon()
	{
		return $this->entity->getOption('monetization.adsense.enabled');
	}

	/**
	 * Check if Project's Niche has content or not
	 *
	 * @return bool
	 */
	public function contentStatusIcon()
	{
		if(isset($this->entity->niche) && ! empty($this->entity->niche->content))
			return true;

		return false;
	}

	/**
	 * Counts the number of Niches under this Project
	 *
	 * @return integer
	 */
	public function nicheCount()
	{
		if($this->entity->niche == null)
			return 0;

		if($this->entity->niche->children == null)
			return 1;

		return (count($this->entity->niche) + count($this->entity->niche->children));
	}

}