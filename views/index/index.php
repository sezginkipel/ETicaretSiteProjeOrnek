<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$getProducts = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 18");
$getProducts->execute();
$products = $getProducts->fetchAll(PDO::FETCH_OBJ);
?>

<section id="hero" style="max-height: 80vh; width: 100%;">
    <div id="carouselExample" class="carousel slide w-100">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                     class="d-block w-100 h-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.pexels.com/photos/341523/pexels-photo-341523.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                     class="d-block w-100 h-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.pexels.com/photos/279906/pexels-photo-279906.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                     class="d-block w-100 h-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>


<section id="products" class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3">Son Eklenenler</h2>
            </div>
            <div class="col-12">
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
        </div>
    </div>
</section>


<style>
    #hero {
        max-height: 100vh;
        overflow: hidden;
        height: 100%;
    }


</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
