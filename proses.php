<?php
include 'FPGrowth.php';

$data = 'dataset/' . $_FILES['data']['name'];
move_uploaded_file($_FILES['data']['tmp_name'], $data);

$dataset = array();
foreach(file($data) as $listProduct) {
    $products = explode(',', $listProduct);
    $set = array();
    foreach($products as $product) {
        $set[$product] = $product;
    }
    $dataset[] = $set;
}

$fpgrowth = new FPGrowth();
foreach($dataset as $set) {
    $fpgrowth->set($set);
}
$fpgrowth->get();
	// Menghitung support count untuk setiap item
	$fpgrowth->countSupportCount();
	// Menampilkan item support count
	// echo "Item | Support Count not ordered";
	// $fpgrowth->getSupportCount();
	// Mengurutkan item by support count
	$fpgrowth->orderBySupportCount();
	// echo "Item | Support Count ordered";
	// $fpgrowth->getSupportCount();
	$fpgrowth->removeByMinimumSupport($fpgrowth->supportCount);
	// echo "Item | Support Count remove support count < minimum support count";
	// $fpgrowth->getSupportCount();
	// Mengurutkan frequent 1-item berdasarkan support count
	// dan menghilangkan item dengan support count kurang dari minimum support count
	$fpgrowth->orderFrequentItem($fpgrowth->frequentItem, $fpgrowth->supportCount);
	// Menampilkan urutan tampilan berdasarkan support count
	// echo "Output Frequent 1-item ordered by support count on each item";
	// $fpgrowth->getOrderedFrequentItem();
	// echo "FP Tree result dislpay in array";
	$fpgrowth->FPTree 	= $fpgrowth->buildFPTree($fpgrowth->orderedFrequentItem);
	// $fpgrowth->getFPTree();

    file_put_contents('hasil.txt', serialize($fpgrowth->FPTree));
    header('location:result.php');