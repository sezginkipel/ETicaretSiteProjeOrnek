<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$categorySlug = @getParams()[1];
$getCategory = $db->prepare("SELECT * FROM categories WHERE slug = :slug");
$getCategory->bindParam(':slug', $categorySlug);
$getCategory->execute();

if($getCategory->rowCount() == 0){
    header('Location: ' . BASE_URL);
}

$category = $getCategory->fetch(PDO::FETCH_OBJ);

$getProducts = $db->prepare("SELECT * FROM products WHERE categoryID = :categoryID");
$getProducts->bindParam(':categoryID', $category->id);
$getProducts->execute();
$products = $getProducts->fetchAll(PDO::FETCH_OBJ);

?>
<section id="categories">
    <div class="container mt-5">
        <div class="row row-cols-4 row-gap-3">
            <div class="col-12">
                <h1><?=$category->title?></h1>
                <p><?=$category->description?></p>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-3 row-gap-3">
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
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
