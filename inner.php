<?php
echo "<a href='index.php'>back</a><br>";
$base_url ="https://coinmarketcap.com/currencies/bitcoin/";

$curl = curl_init($base_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

$page = curl_exec($curl);

if(!empty($page)){
    $DOM = new DOMDocument;
    libxml_use_internal_errors(true);
    $DOM->loadHTML($page);
    libxml_clear_errors();

    $DOM = new DOMXPath($DOM);
    $data=[];
    $price = $DOM->query("//div[contains(@class, 'priceValue')]")[0];
    $d_change = $DOM->query("//div[contains(@class, 'priceTitle')]/span[contains(@class, 'sc-15yy2pl-0 gEePkg')]")[0];
    $market_cap = $DOM->query("//div[contains(@class, 'statsValue')]")[0];
    $fully_diluted_market_cap = $DOM->query("//div[contains(@class, 'statsValue')]")[1];
    $volume = $DOM->query("//div[contains(@class, 'statsValue')]")[2];
    $watchlist = $DOM->query("//div[contains(@class, 'namePill')]")[2];
    $rank = $DOM->query("//div[contains(@class, 'namePill')]")[0];
$data[]=[$price->textContent,$d_change->textContent,$market_cap->textContent,$fully_diluted_market_cap->textContent,$volume->textContent,$watchlist->textContent,$rank->textContent];
print_r($data);
}
#namePill