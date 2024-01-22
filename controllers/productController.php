<?php
$router = new Router();
$productSlug = @getParams()[1];

$router->get("urun/$productSlug", function () {
    loadView('product/details', 'Ürün Detayları');
});

$router->post("urun/ara", function () {
    loadView('product/search', 'Arama Sonuçları');
});

$router->get("sepet", function () {
    loadView('product/cart', 'Sepetim');
});

$router->post("urun/sepete-ekle", function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));
    $productId = removeSpecialChars($reqData->productId);
    $inputQuantity = removeSpecialChars($reqData->productQuantity);

    if ($inputQuantity < 1){
        $response = [
            'status' => 'error',
            'message' => 'Lütfen geçerli bir adet girin!'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    if (isset($_SESSION['user'])) {
        // Üyeyse ve giriş yaptıysa sepete ekle
        $userSessionObj = $_SESSION['user'];
        $userId = $userSessionObj->id;

        $getCartQuery = $db->prepare("SELECT * FROM cart WHERE userID = :userID");
        $getCartQuery->bindParam(':userID', $userId, PDO::PARAM_INT);
        $getCartQuery->execute();
        $getCart = $getCartQuery->fetch(PDO::FETCH_OBJ);

        if($getCartQuery->rowCount() > 0){ // Sepet varsa
            $getCartItemsQuery = $db->prepare("SELECT * FROM cartitems WHERE cartId = :cartId AND productId = :productId");
            $getCartItemsQuery->bindParam(':cartId', $getCart->id, PDO::PARAM_INT);
            $getCartItemsQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $getCartItemsQuery->execute();

            if($getCartItemsQuery->rowCount() >= 1){ // Sepette ürün varsa ürünü güncelle
                $updateCartItemQuery = $db->prepare("UPDATE cartitems SET quantity = quantity + :quantity WHERE cartId = :cartId AND productId = :productId");
                $updateCartItemQuery->bindParam(':cartId', $getCart->id, PDO::PARAM_INT);
                $updateCartItemQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
                $updateCartItemQuery->bindParam(':quantity', $inputQuantity, PDO::PARAM_INT);
                $updateCartItemQuery->execute();
                $response = [
                    'status' => 'success',
                    'message' => 'Ürün sepete eklendi!'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else { // Sepette ürün yoksa ürünü ekle
                $addCartItemQuery = $db->prepare("INSERT INTO cartitems (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
                $addCartItemQuery->bindParam(':cartId', $getCart->id, PDO::PARAM_INT);
                $addCartItemQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
                $addCartItemQuery->bindParam(':quantity', $inputQuantity, PDO::PARAM_INT);
                $addCartItemQuery->execute();
                $response = [
                    'status' => 'success',
                    'message' => 'Ürün sepete eklendi!'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }else{ // Sepet yoksa sepet oluştur ve ürünü ekle
            $addCartQuery = $db->prepare("INSERT INTO cart (userID) VALUES (:userID)");
            $addCartQuery->bindParam(':userID', $userId, PDO::PARAM_INT);
            $addCartQuery->execute();
            $addCartFetch = $addCartQuery->fetch(PDO::FETCH_OBJ);

            $addCartItemQuery = $db->prepare("INSERT INTO cartitems (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
            $addCartItemQuery->bindParam(':cartId', $addCartFetch->lastInsertId(), PDO::PARAM_INT);
            $addCartItemQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $addCartItemQuery->bindParam(':quantity', $inputQuantity, PDO::PARAM_INT);
            $addCartItemQuery->execute();
            $response = [
                'status' => 'success',
                'message' => 'Ürün sepete eklendi!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }


    } else {
        // Üye değilse cookie'ye ekle
        $_COOKIE['cart'] = json_encode([
            'product' => [
                [
                    'id' => $productId,
                    'quantity' => 1
                ]
            ]
        ]);

        setcookie('cart', $_COOKIE['cart'], time() + (86400 * 30), "/");

        $response = [
            'status' => 'success',
            'message' => 'Ürün sepete eklendi!'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
});