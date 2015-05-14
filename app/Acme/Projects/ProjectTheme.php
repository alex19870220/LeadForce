<?php namespace Acme\Projects;

use ProjectOptions;

class ProjectTheme {

	/**
	 * @var Project $projectOptions
	 */
	protected $projectOptions;

	/**
	 * @var array $projectThemes
	 */
	protected $projectThemes = [
		'default' => [
			'label'		=> 'Default Theme',
			'folder'	=> 'default',
		],
	];

	protected $cssColors = [
		'bg-light',	'bg-dark',
		'bg-black',	'bg-primary',
		'bg-success','bg-info',
		'bg-warning','bg-danger',
		],
		'variants' => [
			'dker',
			'dk',
			'',
			'lt',
			'lter',
			],
		];

}