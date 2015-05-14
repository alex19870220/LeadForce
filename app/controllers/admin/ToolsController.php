<?php

use Acme\Keywords\KeywordGrouper;

class ToolsController extends AdminController {

	/*
	|---------------------------
	| Keyword Grouper
	|---------------------------
	|
	|
	*/

	/**
	 * Keyword Grouper page
	 *
	 * @return Response
	 */
	public function getKeywordGrouper()
	{
		return View::make('backend.tools.keyword-grouper');
	}

	/**
	 * Grouping keywords
	 *
	 * @return Response
	 */
	public function postKeywordGrouper()
	{
		// Setup keywords
		$keywords = Input::get('keywords');
		$keywords = explode(PHP_EOL, $keywords);
		$keywords = array_map('trim', $keywords);

		// Group keywords
		$keywordGroups = KeywordGrouper::groupKeywords($keywords);

		// Group limit
		$groupLimit = (! is_numeric(Input::get('group_limit')) || Input::get('group_limit') <= 5 || Input::get('group_limit') >= 25) ? 5 : Input::get('group_limit');

		return View::make('backend.tools.keyword-grouper', ['keywordGroups' => $keywordGroups, 'groupLimit' => $groupLimit]);
	}

	/*
	|---------------------------
	| Keyword Multiplier
	|---------------------------
	|
	|
	*/

	/**
	 * Keyword Multiplier page
	 *
	 * @return Response
	 */
	public function getKeywordMultiplier()
	{
		return View::make('backend.tools.keyword-multiplier');
	}

	public function postKeywordMultiplier()
	{
		$groups = [];
		$groups[0] = $this->processGroup('group_a');
		$groups[1] = $this->processGroup('group_b');
		$groups[2] = $this->processGroup('group_b');
		$groups = array_values(array_filter($groups));

		$keywords = [];

		// Multiply!
		foreach($groups as $groupKeywords)
		{
			foreach($groupKeywords as $groupKeyword)
			{
				// $keywords[] =
			}
		}

		return View::make('backend.tools.keyword-multiplier', ['keywords' => $keywords]);
	}

	/**
	 * Processes a keyword group
	 *
	 * @param  string $group
	 * @return array $group
	 */
	protected function processGroup($group)
	{
		$group =  Input::get($group);

		if(empty($group))
			return false;

		$group = explode(PHP_EOL, $group);
		$group = array_map('trim', $group);
		$group = array_map('strtolower', $group);
		$group = array_unique($group);

		return $group;
	}

}