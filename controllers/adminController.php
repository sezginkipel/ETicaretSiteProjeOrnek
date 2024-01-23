<?php
$router = new Router();

$router->get('yonetim-paneli', function (){
    loadView('admin/index/index', 'Yönetim Paneli');
});

/*| Ürünlerle ilgili yönetimsel işlemler |*/
$router->get('yonetim-paneli/urunler/ekle', function (){
    loadView('admin/product/add', 'Ürün Ekle');
});

$router->post('yonetim-paneli/urunler/ekle', function (){
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $title = removeSpecialChars($reqData->product_title);
    $price = removeSpecialChars($reqData->product_price);
    $img = removeSpecialChars($reqData->product_img);
    $categoryId = removeSpecialChars($reqData->product_category);
    $description = removeSpecialChars($reqData->product_description);

    $addProduct = $db->prepare('INSERT INTO products SET title = ?, price = ?, imgURL = ?, categoryID = ?, description = ?, slug = ?');

    if($addProduct->execute([$title, $price, $img, $categoryId, $description, createSlug($title)]))
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Ürün başarıyla eklendi.']);
    }
    else
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Ürün eklenirken bir hata oluştu.']);
    }




});