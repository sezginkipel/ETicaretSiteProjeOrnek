<?php
$router = new Router();
$productSlug = @getParams()[1];

$router->get("urun/$productSlug", function () {
    loadView('product/details', 'Ürün Detayları');
});

$router->post("urun/ara", function () {
    loadView('product/search', 'Arama Sonuçları');
});

$router->post("urun/sepete-ekle", function () {
    global $db;
    $productId = removeSpecialChars($_POST['productId']);

    if (isset($_SESSION['user'])) {
        // Üyeyse ve giriş yaptıysa sepete ekle
        $userId = $_SESSION['user']['id'];

        $getCartQuery = $db->prepare("SELECT * FROM carts WHERE userID = :userID");
        $getCartQuery->bindParam(':userID', $userId, PDO::PARAM_INT);
        $getCartQuery->execute();
        $getCart = $getCartQuery->fetch(PDO::FETCH_OBJ);

        if($getCart->rowCount() > 0){ // Sepet varsa
            $getCartItemsQuery = $db->prepare("SELECT * FROM cartitems WHERE cartId = :cartId AND productId = :productId");
            $getCartItemsQuery->bindParam(':cartId', $getCart->id, PDO::PARAM_INT);
            $getCartItemsQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $getCartItemsQuery->execute();

            if($getCartItemsQuery->rowCount() >= 1){ // Sepette ürün varsa ürünü güncelle
                $updateCartItemQuery = $db->prepare("UPDATE cartitems SET quantity = quantity + 1 WHERE cartId = :cartId AND productId = :productId");
                $updateCartItemQuery->bindParam(':cartId', $getCart->id, PDO::PARAM_INT);
                $updateCartItemQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
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
                $addCartItemQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $quantity = 1;
                $addCartItemQuery->execute();
                $response = [
                    'status' => 'success',
                    'message' => 'Ürün sepete eklendi!'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            }
        }else{ // Sepet yoksa sepet oluştur ve ürünü ekle
            $addCartQuery = $db->prepare("INSERT INTO carts (userID) VALUES (:userID)");
            $addCartQuery->bindParam(':userID', $userId, PDO::PARAM_INT);
            $addCartQuery->execute();

            $addCartItemQuery = $db->prepare("INSERT INTO cartitems (cartId, productId, quantity) VALUES (:cartId, :productId, :quantity)");
            $addCartItemQuery->bindParam(':cartId', $addCartItemQuery->lastInsertId(), PDO::PARAM_INT);
            $addCartItemQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $addCartItemQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $quantity = 1;
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
            'products' => [
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