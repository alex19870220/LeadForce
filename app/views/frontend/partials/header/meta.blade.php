	<link rel="canonical" href="{{ Request::getUri() }}" />
	<link rel="author" href="{{ $project->social['googleplus'] }}" />
	<link rel="publisher" href="{{ $project->social['googleplus'] }}" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{ $project->present()->pageTitle($__env->yieldContent('title')) }}" />
	<meta property="og:description" content="{{ $project->niche->meta_description }}" />
	<meta property="og:url" content="{{ $project->present()->homeUrl }}" />
	<meta property="og:site_name" content="{{ $project->website_title }}" />
	<meta property="article:publisher" content="" />
	<meta property="og:image" content="" />
	<meta name="twitter:card" content="{{ '@' . $project->social['twitter'] }}" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:domain" content="" />
	<meta name="twitter:creator" content="" />