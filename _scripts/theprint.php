<?php

function fetch_page($pageNumber, $articlesOnly = false) {
	$url = "https://theprint.in/wp-json/wp/v2/posts?context=embed&per_page=100&page=$pageNumber&type=post&tags=457449";
	echo "Fetching $url\n";
	$contents = file_get_contents($url);
	return json_decode($contents);
}

$articles = [];

for($i=1;;$i++) {
	$pageArticles = fetch_page($i, true);
	if(count($pageArticles) == 0) {
		break;
	}
	foreach($pageArticles as $a) {
		$articles[] = ['THEPRINT-' . $a->id, $a->title->rendered, $a->date, $a->link];
	}
	if(count($pageArticles) <100) {
		break;
	}
}

$fp = fopen('theprint.csv', 'w');

fputcsv($fp, ['id', 'title', 'date', 'url']);
foreach($articles as $row) {
	fputcsv($fp, $row);
}

fclose($fp);