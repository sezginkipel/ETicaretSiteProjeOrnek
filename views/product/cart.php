<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>
<?php

global $db;
$getCart = $db->prepare('SELECT * FROM cart WHERE userID = :userID');
$getCart->bindParam(':userID', $_SESSION['user']->id, PDO::PARAM_INT);
$getCart->execute();

$getCartItems = $db->prepare('SELECT * FROM cartitems WHERE cartId = :cartId');
$getCartItems->bindParam(':cartId', $getCart->fetch(PDO::FETCH_OBJ)->id, PDO::PARAM_INT);
$getCartItems->execute();
$cartItems = $getCartItems->fetchAll(PDO::FETCH_OBJ);
?>

<section id="cart">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="fs-3">Sepetim</h1>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8 mt-3 mt-md-0">

                <div class="row row-cols-1 row-gap-4">
                    <?php foreach ($cartItems as $cartItem) {

                        $getProducts = $db->prepare('SELECT * FROM products WHERE id = :productId');
                        $getProducts->bindParam(':productId', $cartItem->productId, PDO::PARAM_INT);
                        $getProducts->execute();
                        $product = $getProducts->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="col">
                            <div class="card bg-light shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div>
                                        <img src="<?= $product->imgURL ?>" alt=""
                                             style="max-height: 96px; max-width: 96px; width: 100%;"
                                             class="rounded-circle overflow-hidden p-3">
                                    </div>

                                    <div class="ms-3">
                                        <h5 class="card-title"><?= $product->title ?></h5>
                                        <p class="card-text">With supporting text below as a natural lead-in to
                                            additional
                                            content.</p>
                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <small id="quantity">
                                            <?= $cartItem->quantity ?> adet <?= $product->price ?>₺ = <?= $cartItem->quantity * $product->price ?>₺
                                        </small>

                                    </div>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-danger">Sil</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                <!--| Checkout |-->
                <div class="card bg-light shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Toplam Tutar</span>
                            <span>
                                <?php
                                $totalPrice = 0;
                                foreach ($cartItems as $cartItem) {
                                    $getProducts = $db->prepare('SELECT * FROM products WHERE id = :productId');
                                    $getProducts->bindParam(':productId', $cartItem->productId, PDO::PARAM_INT);
                                    $getProducts->execute();
                                    $product = $getProducts->fetch(PDO::FETCH_OBJ);

                                    $totalPrice += $cartItem->quantity * $product->price;
                                }
                                echo $totalPrice;
                                ?>₺
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>KDV</span>
                            <span>
                                <?php
                                $totalPrice = 0;
                                foreach ($cartItems as $cartItem) {
                                    $getProducts = $db->prepare('SELECT * FROM products WHERE id = :productId');
                                    $getProducts->bindParam(':productId', $cartItem->productId, PDO::PARAM_INT);
                                    $getProducts->execute();
                                    $product = $getProducts->fetch(PDO::FETCH_OBJ);

                                    $totalPrice += $cartItem->quantity * $product->price;
                                }
                                echo $totalPrice * 0.18;
                                ?>₺
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Toplam</span>
                            <span>
                                <?php
                                $totalPrice = 0;
                                foreach ($cartItems as $cartItem) {
                                    $getProducts = $db->prepare('SELECT * FROM products WHERE id = :productId');
                                    $getProducts->bindParam(':productId', $cartItem->productId, PDO::PARAM_INT);
                                    $getProducts->execute();
                                    $product = $getProducts->fetch(PDO::FETCH_OBJ);

                                    $totalPrice += $cartItem->quantity * $product->price;
                                }
                                echo $totalPrice * 1.18;
                                ?>₺
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>Ödenecek Tutar</span>
                            <span>
                                <?php
                                $totalPrice = 0;
                                foreach ($cartItems as $cartItem) {
                                    $getProducts = $db->prepare('SELECT * FROM products WHERE id = :productId');
                                    $getProducts->bindParam(':productId', $cartItem->productId, PDO::PARAM_INT);
                                    $getProducts->execute();
                                    $product = $getProducts->fetch(PDO::FETCH_OBJ);

                                    $totalPrice += $cartItem->quantity * $product->price;
                                }
                                echo $totalPrice * 1.18;
                                ?>₺
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-dark w-100 btn-lg mt-2 mb-2">Ödeme Yap</button>
                    </div>
                </div>




            </div>
        </div>
    </div>
</section>
