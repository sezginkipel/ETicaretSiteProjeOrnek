<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$keyword = removeSpecialChars($_POST['keyword']);
$searchParam = "%$keyword%";

$getProducts = $db->prepare("SELECT * FROM products WHERE title LIKE :keyword OR description LIKE :keyword");
$getProducts->bindParam(':keyword', $searchParam, PDO::PARAM_STR);
$getProducts->execute();

$products = $getProducts->fetchAll(PDO::FETCH_OBJ);
?>
<section id="categories">
    <div class="container mt-5">
        <div class="row">
            <?php if($getProducts->rowCount() < 1){?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        Aradığınız kelimeye uygun ürün bulunamadı!
                        <a href="<?=BASE_URL?>">Ana Sayfa</a>
                    </div>
                </div>
            <?php die(); } ?>
            <div class="col-12">
                <h1 class="fs-3"><?=$keyword?> için arama sonuçları</h1>
                <hr>
            </div>
        </div>
        <div class="row row-cols-2 row-gap-3">
            <?php foreach ($products as $product){ ?>
                <div class="col">
                    <div class="card">
                        <img src="<?=$product->imgURL?>" class="card-img-top" alt="<?=$product->title?>" style="width: 50%; margin: 0 auto">
                        <div class="card-body">
                            <hr>
                            <h5 class="card-title">
                                <a href="<?=BASE_URL?>urun/<?=createSlug($product->title)?>" class="link-dark">
                                    <?=substr($product->title, 0, 30)?>...
                                </a>
                            </h5>
                            <hr>
                            <p class="card-text"><?=substr($product->description, 0, 150)?>...</p>
                            <a href="<?=BASE_URL?>urun/<?=createSlug($product->title)?>" class="btn btn-primary">Ürün Detayları</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
