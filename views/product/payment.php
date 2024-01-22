<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>
<?php

global $db;


if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'giris');
} else {
    $user = $_SESSION['user'];
}

$getCart = $db->prepare('SELECT * FROM cart WHERE userID = :userID');
$getCart->bindParam(':userID', $_SESSION['user']->id, PDO::PARAM_INT);
$getCart->execute();

$getCartItems = $db->prepare('SELECT * FROM cartitems WHERE cartId = :cartId');
$getCartItems->bindParam(':cartId', $getCart->fetch(PDO::FETCH_OBJ)->id, PDO::PARAM_INT);
$getCartItems->execute();
$cartItems = $getCartItems->fetchAll(PDO::FETCH_OBJ);

$getAddresses = $db->prepare('SELECT * FROM addresses WHERE customerId = :customerId');
$getAddresses->bindParam(':customerId', $user->id);
$getAddresses->execute();
$address = $getAddresses->fetch(PDO::FETCH_OBJ);
?>
<script>
    function fillAddress (){
        document.querySelector('#input_nameSurname').value = '<?=$address->customerName?>';
        document.querySelector('#input_address').value = '<?=$address->addressDetails?>';
        document.querySelector('#input_city').value = '<?=$address->city?>';
        document.querySelector('#input_postCode').value = '<?=$address->postCode?>';
        document.querySelector('#input_phoneNumber').value = '<?=$address->phoneNumber?>';
        document.querySelector('#input_email').value = '<?=$address->email?>';

    }

</script>
<section id="cart">
    <div class="container mt-5 mb-5">
        <form action="#" method="post" id="form_confirmPayment">
            <div class="row">
                <div class="col-12">
                    <h1 class="fs-3">Siparişinin Hazırlanmasına <small class="small text-muted fw-light">son bir adım
                            kaldı</small></h1>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-8 mt-3 mt-md-0">

                    <div class="row row-cols-1 row-gap-4">
                        <div>
                            <div class="col">
                                <div class="card bg-light shadow-sm">
                                    <div class="card-header d-flex justify-content-between p-3">
                                        <h2 class="fs-3">Fatura ve Adres Bilgileri</h2>
                                        <button type="button" class="btn btn-dark" onclick="fillAddress()">Doldur</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-cols-1 row-gap-4">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_nameSurname"
                                                           placeholder="Ad Soyad" required>
                                                    <label for="input_nameSurname">Ad Soyad</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_address"
                                                           placeholder="Adres" required>
                                                    <label for="input_address">Adres</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_city"
                                                           placeholder="Şehir" required>
                                                    <label for="input_city">Şehir</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_postCode"
                                                           placeholder="Posta Kodu" required>
                                                    <label for="input_postCode">Posta Kodu</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_phoneNumber"
                                                           placeholder="Telefon" required>
                                                    <label for="input_phoneNumber">Telefon</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_email"
                                                           placeholder="E-Posta" required>
                                                    <label for="input_email">E-Posta</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-3">
                                <div class="card bg-light shadow-sm">
                                    <div class="card-header p-3">
                                        <h2 class="fs-3">Ödeme Bilgileri</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-cols-1 row-gap-4">
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_creditCardOwner"
                                                           placeholder="Kart Sahibi" required>
                                                    <label for="input_creditCardOwner">Kart Sahibi</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="input_creditCardNo"
                                                           placeholder="Kart Numarası">
                                                    <label for="input_creditCardNo">Kart Numarası</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="month" pattern="mm/yy" class="form-control" id="input_creditCardExpDate"
                                                           placeholder="Son Kullanma Tarihi">
                                                    <label for="input_creditCardExpDate">Son Kullanma Tarihi</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating mb-3">
                                                    <input type="number" class="form-control" id="input_creditCardCVV"
                                                           placeholder="CVV">
                                                    <label for="input_creditCardCVV">CVV</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                    <!--| Checkout |-->
                    <div class="card bg-light shadow-sm">

                        <div class="card-header p-3">
                            <h2 class="fs-3">Ödeme Özeti</h2>
                        </div>

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
                            <button type="submit" id="btn_confirmOrder" class="btn btn-dark w-100 btn-lg mt-2 mb-2">
                                Siparişi
                                Onayla
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form_confirmPayment = document.querySelector('#form_confirmPayment');

    form_confirmPayment.addEventListener('submit', (e) => {
        e.preventDefault();
        Swal.fire({
            title: "Teşekkürler",
            text: "Siparişiniz alındı. En kısa sürede kargoya verilecektir.",
            width: 600,
            padding: "3em",
            color: "#716add",
            background: "#fff url(https://sweetalert2.github.io/images/trees.png)",
            backdrop: `
    rgba(0,0,123,0.4)
    url("https://sweetalert2.github.io/images/nyan-cat.gif")
    left top
    no-repeat
  `
        });

    });
</script>
