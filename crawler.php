<?php
include 'simple_html_dom.php';
ini_set('user_agent', 'Web-Crawler/2.5');
$html = file_get_html('https://w3schools.com');

$dom = $html->find("div.w3-card-2.w3-round");
$titles = [];
$links = [];
$descs = [];

foreach ($dom as $element) {
    foreach ( $element->find('[style=font-size:45px;font-weight:700]') as $h2){
        $titles[] = $h2->innerText();
    }
        forEach($element->find('a.w3-button.black-color') as $link){
            if($link->hasAttribute('href')){
                $links[] = $link->getAttribute('href');
            }
        }
}

// fetch links
$links = array_map(function($link){
    return 'https://w3schools.com'.$link;
}, $links);

foreach ($links as $link) {
    $html = file_get_html($link);
    $dom = $html->find("div.w3-panel.w3-info.intro");
    foreach ($dom as $element) {
        $desc = '';
        foreach ( $element->find('p') as $p){
            echo $desc .= $p->innerText();
        }
        $descs[] = $desc;
    }
}

$file = fopen('data.csv', 'w');
// insert data with title, link, desc
fputcsv($file, ['Title', 'Link', 'Description']);
foreach ($titles as $key => $title) {
    fputcsv($file, [$title, $links[$key], $descs[$key] ?? '']);
}

