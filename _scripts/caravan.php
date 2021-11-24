<?php
const URL_PREFIX = 'https://caravanmagazine.in';
function fetch_page($pageNumber, $articlesOnly = false) {
	$url = "https://caravanmagazine.in/api/articles/list?tagSlug=coronavirus&context=cover&page=$pageNumber";
	echo "Fetching $url\n";
	$contents = file_get_contents($url);
	$data = json_decode($contents);
	if ($articlesOnly) {
		return $data->rows;
	}
	return $data;
}


$data = fetch_page(1);
$totalPageCount = $data->meta->total;
echo "Fetching $totalPageCount pages\n";

$articles = [];

for($i=1; $i<=$totalPageCount; $i++) {
	$pageArticles = fetch_page($i, true);
	assert(len($pageArticles) > 0);
	$articles = array_merge($articles, $pageArticles);
}

$fp = fopen('caravan.csv', 'w');

fputcsv($fp, ['id', 'title', 'date', 'url']);
foreach($articles as $article) {
	$row = ['CARAVAN-' . $article->id, $article->title, $article->writtenAt, URL_PREFIX . $article->slug];
	fputcsv($fp, $row);
}

fclose($fp);