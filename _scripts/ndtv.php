<?php

require('simple_html_dom.php');

function fetch_page($pageNumber) {
    $articles = [];
    $url = "https://www.ndtv.com/page/topic-load-more?type=news&page=$pageNumber&query=coronavirus";
    echo "Fetching $url\n";
    $html = file_get_html($url);
    foreach($html->find('.src_lst-rhs') as $div) {
        $link = $div->find('a', 0);
        $item['url'] = $link->href;
        $tmp = explode('-', $link->href);
        $item['id'] = array_pop($tmp);
        $item['title'] = $link->title;
        $span = $div->find('.src_itm-stx', 0);
        $categoryLink = $span->find('a', 0);
        if ($categoryLink && $categoryLink->innertext == 'India News') {
            $tmp = explode('|', $span->innertext);
            $date = trim(array_pop($tmp));
            $d = new DateTime($date, new DateTimeZone('Asia/Kolkata'));
            $item['date'] = $d->format(DateTime::RFC3339);
            $articles[] = $item;
        }
    }
    return $articles;
}

$articles = [];

for($i=1;; $i++) {
    $pageArticles = fetch_page($i, true);
    if(count($pageArticles) == 0) {
        break;
    }
    $articles = array_merge($articles, $pageArticles);
}

$fp = fopen('ndtv.csv', 'w');

fputcsv($fp, ['id', 'title', 'date', 'url']);
foreach($articles as $article) {
    $row = ['NDTV-' . $article['id'], $article['title'], $article['date'], $article['url']];
    fputcsv($fp, $row);
}

fclose($fp);