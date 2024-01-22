<?php require_once BASE_DIRECTORY . 'views/_components/header.php'; ?>

<?php
global $db;

if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'giris');
} else {
    $user = $_SESSION['user'];
}


$orderQuery = $db->prepare('SELECT * FROM orders WHERE customerID = :customerID');
$orderQuery->bindParam(':customerID', $user->id);
$orderQuery->execute();

$orders = $orderQuery->fetchAll(PDO::FETCH_OBJ);
?>

<section id="user_account">
    <div class="container mt-5">

        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Hoş geldiniz: <strong><?= $user->username ?></strong>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-3">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?=BASE_URL?>hesabim">Siparişlerim</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?=BASE_URL?>hesabim/duzenle">Bilgilerimi Güncelle</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_URL?>hesabim/adreslerim">Adreslerim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_URL?>hesabim/iletisim-bilgilerim">İletişim Bilgilerim</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-9">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php foreach ($orders as $order){ ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-<?=$order->id?>" aria-expanded="false"
                                    aria-controls="flush-<?=$order->id?>">
                                Sipariş No: <?=$order->id?>
                            </button>
                        </h2>
                        <div id="flush-<?=$order->id?>" class="accordion-collapse collapse"
                             data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><?=$order->orderDetails?></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
