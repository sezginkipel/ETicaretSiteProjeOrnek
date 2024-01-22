<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$productSlug = @getParams()[1];
$getProduct = $db->prepare("SELECT * FROM products WHERE slug = :slug");
$getProduct->bindParam(':slug', $productSlug);
$getProduct->execute();

if($getProduct->rowCount() == 0){
    header('Location: ' . BASE_URL);
}

$product = $getProduct->fetch(PDO::FETCH_OBJ);
?>
<section id="categories">
    <div class="container mt-5">
        <div class="row row-cols-2 row-gap-3">
            <div class="col">
                <img src="<?= $product->imgURL ?>" alt="<?= $product->name ?>" class="img-fluid">
            </div>

            <div class="col">
                <h1 class="fs-3"><?= $product->title ?></h1>
                <hr>
                <p><?= $product->description ?></p>
                <p class="fs-3 fw-bold">Fiyat: <?= $product->price ?>₺</p>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
