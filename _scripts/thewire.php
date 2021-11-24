<?php
const URL_PREFIX = 'https://thewire.in/post/';

function fetch_page($pageNumber, $articlesOnly = false) {
	$url = "https://thewire.in/wp-json/thewire/v2/posts/tag/coronavirus?per_page=500&page=$pageNumber&type=post";
	echo "Fetching $url\n";
	$contents = file_get_contents($url);
	$data = json_decode($contents, true);
	if ($articlesOnly) {
		return $data['tag-stories'];
	}
	return $data;
}

$articles = [];

for($i=1; ; $i++) {
	$pageArticles = fetch_page($i, true);
	if(count($pageArticles) == 0) {
		break;
	}
	echo "Got " . count($pageArticles) . "\n";
	$articles = array_merge($articles, $pageArticles);
}

$fp = fopen('thewire.csv', 'w');

fputcsv($fp, ['id', 'title', 'date', 'url']);
foreach($articles as $article) {
	$datetime = new DateTime($article['post_date'], new DateTimeZone('Asia/Kolkata'));
	$row = ['WIRE-' . $article['ID'], $article['post_title'], $datetime->format(DateTime::RFC3339), URL_PREFIX . $article['post_name']];
	fputcsv($fp, $row);
}

fclose($fp);