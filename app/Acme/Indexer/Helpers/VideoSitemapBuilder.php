<?php namespace Acme\Indexer\Helpers;

use Config;
use File;
use Project;
use Response;

class VideoSitemapBuilder {

	/**
	 * @var Project
	 */
	protected $project;

	/**
	 * The array of URLs for the sitemap
	 *
	 * @var array
	 */
	protected $items = [];

	/**
	 * Path to the sitemap
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * Split large Sitemaps into multiple pages
	 *
	 * @var integer
	 */
	protected $perPage = 2000;

	/**
	 * The filename
	 *
	 * @var string
	 */
	protected $filename;

	/**
	 * URL to the sitemap
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * @param int $projectId
	 */
	function __construct($projectId)
	{
		$this->project  = Project::findOrFail($projectId);
		$this->path     = Config::get('acme.dir.sitemap') . "/video/{$this->project->id}";
		$this->perPage	= Config::get('acme.sitemaps.perpage');
		$this->filename = "{$this->project->id}-";
		$this->url      = route('sitemap-video/index', [$this->project->slug, $this->project->tld]);
	}

	/**
	 * Adds a URL to the sitemap
	 *
	 * @param string $url
	 * @param string $video
	 * @param string $pageTitle
	 */
	public function add($url, $video, $pageTitle)
	{
		$this->items[] = [
			'url'		=> $url,
			'video'		=> $video,
			'pageTitle'	=> $pageTitle
			];
	}

	/**
	 * Generates the sitemap & pings search engines
	 *
	 * @param  integer $perPage
	 * @return string $url
	 */
	public function generate()
	{
		ini_set('memory_limit','1024M');
		$num = 0;

		foreach(array_chunk($this->items, $this->perPage) as $items)
		{
			$xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
			$xml .= '<!-- Generated-on="' . date("F j, Y, g:i a") .'" -->' . "\n";

			$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";

			foreach($items as $item)
			{
				$pageTitle = e($item['pageTitle']);

				$xml .= "\n\t<url>\n";
				$xml .= "\t\t<loc>" . $item['url'] . "</loc>\n";
				$xml .= "\t\t<video:video>\n";
				$xml .= "\t\t\t<video:player_loc allow_embed=\"yes\" autoplay=\"autoplay=1\">http://www.youtube.com/v/" . $item['video'] . "</video:player_loc>\n";
				$xml .= "\t\t\t<video:thumbnail_loc>http://i.ytimg.com/vi/" . $item['video'] . "/hqdefault.jpg</video:thumbnail_loc>\n";
				$xml .= "\t\t\t<video:title>" . $pageTitle . "</video:title>\n";
				$xml .= "\t\t\t<video:description>" . $pageTitle . "</video:description>\n";
				// $xml .= "\t\t\t<video:publication_date>" . date (DATE_W3C, strtotime ($the_date)) . "</video:publication_date>\n";
				$xml .= "\t\t</video:video>\n";
				$xml .= "\t</url>";
			}

			$xml .= "\n</urlset>";

			$filename = str_pad($num, 3, '0', STR_PAD_LEFT);

			$file = $this->createFile($filename, $xml);

			$num++;
		}

		$this->generateIndex($num);

		return $this->url;
	}

	/**
	 * Generates the Sitemap index file
	 *
	 * @param  integer $num
	 * @return null
	 */
	public function generateIndex($num = 0)
	{
		$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

		$xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

		for($x = 0;$x < $num;$x++)
		{
			$xml .= "\t<sitemap>\n";
			$xml .= "\t\t<loc>" . route('sitemap-video/view-sitemap', [$this->project->slug, $this->project->tld, str_pad($x, 3, '0', STR_PAD_LEFT)]) . "</loc>\n";
			$xml .= "\t</sitemap>\n";
		}

		$xml .= '</sitemapindex>' . "\n";

		$filename = 'index';

		$this->createFile($filename, $xml);

		static::ping($this->project->id);
	}

	/**
	 * Creates the video sitemap file
	 *
	 * @param  string $contents
	 * @return mixed
	 */
	public function createFile($filename, $contents)
	{
		$path = $this->path;

		if(! File::isDirectory($this->path))
		{
			File::makeDirectory($this->path, 0775);
		}

		File::put($this->path . '/' . $filename . '.xml', $contents);

		return (File::exists($this->path)) ? $this->path : null;
	}

	/**
	 * Pings search engines the given URLs
	 *
	 * @param  string $url
	 * @return boolean
	 */
	public static function ping($projectId)
	{
		$obj = new static($projectId);

		$url = $obj->url;

		$searchEngines = [
				"http://www.google.com/webmasters/tools/ping?sitemap={$url}",
				"http://www.bing.com/ping?sitemap={$url}",
				"http://webmaster.yandex.com/site/map.xml?host={$url}"
			];

		foreach($searchEngines as $searchEngine)
		{
			$ping = @file_get_contents($searchEngine);
		}

		return $obj;
	}

	/**
	 * Render the XML file to be viewed
	 *
	 * @param  string $path
	 * @return Response
	 */
	public static function render($path)
	{
		$headers = [
				'Content-type' => 'text/xml; charset=utf-8'
			];

		if(! File::exists($path))
		{
			return App::abort(404);
		}

		$data = File::get($path);

		return Response::make($data, 200, $headers);
	}

	/**
	 * Static function to get the path to the sitemap
	 *
	 * @param  int $projectId
	 * @return string
	 */
	public static function getPath($projectId)
	{
		$obj = new static($projectId);

		return $obj->path;
	}
}