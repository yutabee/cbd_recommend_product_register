<?php

// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

//フォームの入力値のチェック
if (
    !isset($_POST['concentration']) || $_POST['concentration'] == '' ||
    !isset($_POST['volume']) || $_POST['volume'] == '' ||
    !isset($_POST['all_drop']) || $_POST['all_drop'] == '' ||
    !isset($_POST['all_content']) || $_POST['all_content'] == '' ||
    !isset($_POST['one_drop_content']) || $_POST['one_drop_content'] == '' ||
    !isset($_POST['one_drop_price']) || $_POST['one_drop_price'] == '' ||
    !isset($_POST['image_path']) || $_POST['image_path'] == '' ||
    !isset($_POST['product_link']) || $_POST['product_link'] == '' ||
    !isset($_POST['image_file']) || $_POST['image_file'] == ''

) {
    exit('paramError');
}

// echo '<pre>';
// var_dump($_POST);
// echo '<pre>';
// exit();

$concentration = $_POST['concentration'];
$volume = $_POST['volume'];
$all_drop = $_POST['all_drop'];
$all_content = $_POST['all_content'];
$one_drop_content = $_POST['one_drop_content'];
$one_drop_price = $_POST['one_drop_price'];
$image_path = $_POST['image_path'];
$product_link = $_POST['product_link'];
$image_file = $_POST['image_file'];

$params = [
    'id' => null,
    'concentration' => $_POST['concentration'],
    'volume' => $_POST['volume'],
    'all_drop' => $_POST['all_drop'],
    'all_content' => $_POST['all_content'],
    'one_drop_content' => $_POST['one_drop_content'],
    'one_drop_price' => $_POST['one_drop_price'],
    'image_path' => $_POST['image_path'],
    'link' => $_POST['product_link'],
    // 'image_file' => $_POST['image_file']
];


// DB接続
include('../function.php');
$pdo = connect_to_db();

$count = 0;
$columns = '';
$values = '';

foreach (array_keys($params) as $key) {
    if ($count++ > 0) {
        $columns .= ',';
        $values .= ',';
    }
    $columns .= $key;
    $values .= ':' . $key;
}

$sql = 'insert into cbd_recommend_table (' . $columns . ')values(' . $values . ')';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', null, PDO::PARAM_STR);
$stmt->bindValue(':concentration', $concentration, PDO::PARAM_STR);
$stmt->bindValue(':volume', $volume, PDO::PARAM_STR);
$stmt->bindValue(':all_drop', $all_drop, PDO::PARAM_STR);
$stmt->bindValue(':all_content', $all_content, PDO::PARAM_STR);
$stmt->bindValue(':one_drop_content', $one_drop_content, PDO::PARAM_STR);
$stmt->bindValue(':one_drop_price', $one_drop_price, PDO::PARAM_STR);
$stmt->bindValue(':image_path', $image_path, PDO::PARAM_STR);
$stmt->bindValue(':link', $product_link, PDO::PARAM_STR);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:product_register_input.php");
exit();
