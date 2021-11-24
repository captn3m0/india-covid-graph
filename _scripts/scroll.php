<?php

function fetch_page($pageNumber, $articlesOnly = false) {
	$url = "https://scroll.in/search?q=corona&page=$pageNumber&format=json";
	echo "Fetching $url\n";
	$contents = file_get_contents($url);
	$data = json_decode($contents);
	if ($articlesOnly) {
		return $data->articles;
	}
	return $data;
}


$data = fetch_page(1);
$totalPageCount = $data->total_pages;
echo "Fetching $totalPageCount pages\n";

$articles = [];

for($i=1; $i<=$totalPageCount; $i++) {
	$pageArticles = fetch_page($i, true);
	if(count($pageArticles) == 0) {
		break;
	}
	$articles = array_merge($articles, $pageArticles);
}

$fp = fopen('scroll.csv', 'w');

fputcsv($fp, ['id', 'title', 'date', 'url']);
foreach($articles as $article) {
	$row = ['SCROLL-' . $article->id, $article->title, $article->published, $article->permalink];
	fputcsv($fp, $row);
}

fclose($fp);