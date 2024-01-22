<?php require_once BASE_DIRECTORY . 'views/_components/header.php'; ?>

<?php
global $db;

if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'giris');
} else {
    $user = $_SESSION['user'];
}

$getAddresses = $db->prepare('SELECT * FROM addresses WHERE customerId = :customerId');
$getAddresses->bindParam(':customerId', $user->id);
$getAddresses->execute();
$addresses = $getAddresses->fetchAll(PDO::FETCH_OBJ);
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
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim">Siparişlerim</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= BASE_URL ?>hesabim/duzenle">Bilgilerimi
                            Güncelle</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>hesabim/adreslerim">Adreslerim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim/iletisim-bilgilerim">İletişim Bilgilerim</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-9">
                <div class="row">
                    <div class="col-12">
                        <h1 class="fs-3">Adreslerim</h1>
                        <hr>
                    </div>
                </div>

                <div class="row row-cols-1 column-gap-3">
                    <?php foreach ($addresses as $address){ ?>
                    <div class="col">
                        <div class="card">
                            <h5 class="card-header"><?=$address->title?></h5>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?=$address->customerName?>
                                </h5>
                                <p class="card-text"><?=$address->addressDetails?></p>
                                <small class="card-text"><?=$address->city?></small>
                                /
                                <small class="card-text"><?=$address->postCode?></small>
                            </div>

                            <div class="card-footer">
                                <a href="#" class="btn btn-warning">Adresi Düzenle</a>
                                <a href="#" class="btn btn-danger">Adresi Sil</a>
                            </div>
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
