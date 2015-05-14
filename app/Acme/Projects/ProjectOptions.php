<?php namespace Acme\Projects;

class ProjectOptions {

	/**
	 * Default data
	 *
	 * @var options
	 */
	protected $data = [
		'options' => [
			'process_content_chunks'			=> false,
			'show_newsletter'					=> false,
			'show_user_menu'					=> false,
			'silo_style'						=> 'show_states',
			'top_lander_routes'					=> 'project/home',				//@if(strpos(Route::currentRouteName(), $project->getOption('top_lander_routes')) !== false)

			// Monetizations
			'monetization' => [
				'type'							=> '',							// monetization.type

				// Cloaking
				'cloaking' => [
					'enabled'					=> false,						// monetization.cloaking.enabled
					'url_type'					=> 'custom',					// monetization.cloaking.url_type

					'url' => [
						'custom_url'			=> '',							// monetization.cloaking.url.custom_url
						'homeadvisor_redirect'	=> '',							// monetization.cloaking.url.homeadvisor_redirect
					],

					'cloaked_url'				=> 'http://www.google.com',		// monetization.cloaking.cloaked_url
					'cloak_all_pages'			=> 0,							// monetization.cloaking.cloak_all_pages
					'no_cloak_routes'			=> '',							// monetization.cloaking.no_cloak_routes
					'cloak_by_niche'			=> 0,							// monetization.cloaking.cloak_by_niche
					'cloak_by_niche_urls'		=> [],							// monetization.cloaking.cloak_by_niche_urls
				],

				// Leadgen
				'leadgen' => [
					'enabled'					=> false,						// monetization.leadgen.enabled
					'iframe_type'				=> 'custom',					// monetization.cloaking.iframe_type

					'iframe' => [
						'custom_iframe'			=> '',							// monetization.leadgen.iframe.custom_iframe
						'homeadvisor_iframe'	=> '',							// monetization.leadgen.iframe.homeadvisor_iframe
					],

					'leadgen_by_niche'			=> 0,							// monetization.leadgen.leadgen_by_niche
					'leadgen_by_niche_iframes'	=> '',							// monetization.leadgen.leadgen_by_niche_iframes
				],

				// Adsense
				'adsense' => [
					'enabled'					=> true,						// monetization.adsense.enabled
					'adsense_id'				=> '',							// monetization.adsense.adsense_id
					'adsense_sizes'				=> 'default',					// monetization.adsense.adsense_sizes	small|default|large
					'header' => [
						'enabled'				=> false,						// monetization.adsense.header.enabled
						'size'					=> 'default',					// monetization.adsense.header.size
					],
					'top_content' => [
						'enabled'				=> true,						// monetization.adsense.top_content.enabled
						'size'					=> 'default',					// monetization.adsense.top_content.size
					],
					'content' => [
						'enabled'				=> true,						// monetization.adsense.content.enabled
						'size'					=> 'default',					// monetization.adsense.content.size
						'number_ads'			=> 1,							// monetization.adsense.content.number_ads
					],
					'footer' => [
						'enabled'				=> false,						// monetization.adsense.footer.enabled
						'size'					=> 'default',					// monetization.adsense.footer.size
					],
					'sidebar' => [
						'enabled'				=> false,						// monetization.adsense.sidebar.enabled
						'size'					=> 'default',					// monetization.adsense.sidebar.size
						'location'				=> 'bottom',					// monetization.adsense.sidebar.location
					],
				],

				// Email Optins
				'email_optin' => [												// monetization.email_optin
					'provider'					=> '',							// monetization.email_optin.provider
					'mailchimp' => [
						'api_key'				=> '',							// monetization.email_optin.mailchimp.api_key
						'list'					=> '',							// monetization.email_optin.mailchimp.list
					],
					'icontact' => [
						'account'				=> '',
						'list'					=> '',
					],
					'design' => [
						'exit_intent' => [
							'enabled'			=> false,						// monetization.email_optin.design.exit_intent.enabled
							'form_id'			=> '',							// monetization.email_optin.design.exit_intent.
						],
						'optin_top' => [
							'enabled'			=> false,						// monetization.email_optin.design.optin_top.enabled
							'form_id'			=> '',							// monetization.email_optin.design.optin_top.form_id
						],
						'optin_bottom' => [
							'enabled'			=> false,						// monetization.email_optin.design.optin_top.enabled
							'form_id'			=> '',							// monetization.email_optin.design.optin_top.form_id
						],
					],
				],

				// Lead Gen
				'leadgen' => [
					'type'						=> '',							// lds|homeadvisor
				],
			], // monetization

			// Design Options
			'design' => [														// design
				'header' => [
					'breadcrumbs_show'					=> true,				// design.header.breadcrumbs_show
					'header_sticky'						=> true,				// design.header.header_sticky
				],
				'home' => [														// design.home
					'headline'					=> 'Only The Best <span class="text-success">[MKW]</span>',
					'subheadline'				=> 'Find a Trusted Professional Near You',
					'show_monetization'			=> true,						// design.home.show_monetization
				],
				'lander' => [													// design.lander
					'bgimage'					=> '',							// design.lander.bgimage
				],
				'sidebar' => [
					'position'					=> 'right',						// design.sidebar.position
					'width'						=> '1/4',						// design.sidebar.width
				],
			],

			// SEO
			'seo' => [
				'misc' => [
					'separator'					=> '|',							// Page title separator
				],

				'home' => [
				],
			],
		], // options
	]; // attributes

	/**
	 * Grab the default Project options
	 *
	 * @return stdClass
	 */
	public function getDefaultOptions()
	{
		return json_decode(json_encode($this->data['options']), true);
	}

	/**
	 * Uses chosen options and adds the template in case new options were added
	 *
	 * @param array $options
	 */
	public function setOptionsTemplate($options)
	{
		if(is_object($options))
			$options = json_decode(json_encode($options), true);

		if(is_array($options) && ! empty($options))
			$options = array_dot($options);

		$projectOptions = $this->getDefaultOptions();
		$checkOptions = array_dot($projectOptions);

		// Loop through all options, checking if set
		foreach($checkOptions as $key => $value)
		{
			// If option isn't set
			$newValue = (! isset($options[$key])) ? false : $options[$key];



			// If option isn't set, and default isn't boolean
			$newValue = (! isset($options[$key]) && empty($options[$key]) && ! is_bool($value)) ? $value : $newValue;

			if($newValue == 'on')
				$newValue = true;

			array_set($projectOptions, $key, $newValue);
		}

		// dd($projectOptions);

		// return $projectOptions;
		return json_decode(json_encode($projectOptions), true);
	}

	/**
	 * Get option value from a key
	 *
	 * @param  string $key
	 * @return value
	 */
	public function getOption($key)
	{
		return array_get($this->$data['options'], $key, null);
	}

}