
<?php
echo "<a href='inner.php'>bitcoin link</a><br>";
$base_url ="https://coinmarketcap.com/";

$curl = curl_init($base_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

$page = curl_exec($curl);
$date= [];
if(!empty($page)){
    $DOM = new DOMDocument;
    libxml_use_internal_errors(true);
    $DOM->loadHTML($page);
    libxml_clear_errors();

    $DOM = new DOMXPath($DOM);
    $data = []; 
    $urls = $DOM->query("//tbody//tr//td//div/a[not(contains(@href,'markets'))]/@href");
    #cmc-link //production[not(contains(category,'Business'))]
    foreach ($urls as $url)
    {
    $data []=["url"=>($base_url.$url->textContent)];
}
print_r($data);

}