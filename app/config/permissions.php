<?php

return [

	// 'Admin' => [
	// 	[
	// 		'permission' => 'admin',
	// 		'label'      => 'Administrator',
	// 	],
	// ],

	'Section Access' => [
		[
			'permission' => 'access.projects',
			'label'      => 'Project access',
		],
		[
			'permission' => 'access.niches',
			'label'      => 'Niche access',
		],
		[
			'permission' => 'access.appearance',
			'label'      => 'Appearance access',
		],
		[
			'permission' => 'access.monetizations',
			'label'      => 'Monetizations access',
		],
		[
			'permission' => 'access.indexer',
			'label'      => 'Indexer access',
		],
		[
			'permission' => 'access.users',
			'label'      => 'User access',
		],
		[
			'permission' => 'access.settings',
			'label'      => 'Settings access',
		],
	],

	'Projects' => [
		[
			'permission' => 'projects.viewall',
			'label'      => 'View other users\' Projects',
		],
		[
			'permission' => 'projects.clearcache',
			'label'      => 'Can clear Project cache',
		],
	],

	'Users' => [
		[
			'permission' => 'user.create',
			'label'      => 'Create users',
		],
		[
			'permission' => 'user.update',
			'label'      => 'Update users',
		],
		[
			'permission' => 'user.delete',
			'label'      => 'Delete users',
		],
	],

];