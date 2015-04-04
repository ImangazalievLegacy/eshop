<?php

	$categories = Category::getAll();

	$lastLevel = 0;

	foreach ($categories as $category) {

		$url = URL::route('category-index', $category->url);

		$tab = str_repeat('• ', $category->level);

		echo $tab, "<a href=\"$url\">$category->title</a>", '<br>', PHP_EOL;

	}