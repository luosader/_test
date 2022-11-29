<?php 

$xml = new DOMDocument('1.0','utf-8');
$xml->load('./1.xml');
$xpath = new DOMXPath($xml);
$sql = '/bookstore/book[1]/title';

$rs = $xpath->query($sql);

// var_dump($rs);
echo $rs->item(0)->nodeValue;

$sql = '//title[1][last()]';
$rs = $xpath->query($sql);
echo $rs->item(0)->nodeValue;

?>