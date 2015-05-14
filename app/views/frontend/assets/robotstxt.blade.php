User-agent: *
Allow: /
Sitemap: {{ URL::route('sitemap/index', [$project->slug, $project->tld])}}
Sitemap: {{ URL::route('sitemap-video/index', [$project->slug, $project->tld])}}