<?php
include 'simple_html_dom.php';
ini_set('user_agent', 'Web-Crawler/2.5');

// Fetch the HTML
$html = file_get_contents('https://yourpetpa.com.au');

// Clean up the HTML with regular expressions
$html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $html); // Remove scripts
$html = preg_replace('/<!--(.|\s)*?-->/', '', $html); // Remove comments
$html = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html); // Remove style tags

// Load the HTML into a DOM object
$dom = new simple_html_dom();
$dom->load($html);

// Fetch all div elements
$divs = $dom->find('div.product__content__wrap');

// Loop through each div element and fetch the title, image, and price as well as insert into data.csv
$fp = fopen('data.csv', 'w');
fputcsv($fp, ['Title', 'Image', 'Price']);

foreach ($divs as $div) {
    // Fetch the title .product-block__image-container and .product-block__title
    $title = $div->find('.product-block__title a', 0)->innerText();
    $image = $div->find('.product-block__image-container .image-one img', 0)->getAttribute('data-src');
    $price = $div->find('.product-price > .theme_money', 0)->innerText();

    // Write the data to the CSV file
    fputcsv($fp, [$title, $image, $price]);
}

fclose($fp);