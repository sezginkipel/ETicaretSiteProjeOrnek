<?php
$router = new Router();

$router->get('yonetim-paneli', function () {
    loadView('admin/index/index', 'Yönetim Paneli');
});

/*| Ürünlerle ilgili yönetimsel işlemler |*/
$router->get('yonetim-paneli/urunler/ekle', function () {
    loadView('admin/product/add', 'Ürün Ekle');
});

$router->post('yonetim-paneli/urunler/ekle', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $title = removeSpecialChars($reqData->product_title);
    $price = removeSpecialChars($reqData->product_price);
    $img = removeSpecialChars($reqData->product_img);
    $categoryId = removeSpecialChars($reqData->product_category);
    $description = removeSpecialChars($reqData->product_description);

    $addProduct = $db->prepare('INSERT INTO products SET title = ?, price = ?, imgURL = ?, categoryID = ?, description = ?, slug = ?');

    if ($addProduct->execute([$title, $price, $img, $categoryId, $description, createSlug($title)])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Ürün başarıyla eklendi.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Ürün eklenirken bir hata oluştu.']);
    }
});

$router->post('yonetim-paneli/urunler/gorsel-yukle', function () {

    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $file = $_FILES['product_imgFile'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    $fileExt = explode('.', $fileName);

    $fileActualExt = strtolower(end($fileExt));
    $allowed = ['jpg', 'jpeg', 'png', 'svg', 'webp'];

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . '.' . $fileActualExt;
                $fileDestination = BASE_DIRECTORY . 'public/uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $response = [
                    'status' => 'success',
                    'message' => 'Dosya başarıyla yüklendi.',
                    'fileUrl' => BASE_URL . 'public/uploads/' . $fileNameNew
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Dosya boyutu çok büyük.'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Dosya yüklenirken bir hata oluştu.'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Bu dosya türü desteklenmiyor.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }


});