<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$getProducts = $db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 18");
$getProducts->execute();
$products = $getProducts->fetchAll(PDO::FETCH_OBJ);
?>


<main>
    <section id="section_hero">
        <div id='hero_slider' class="carousel slide hero_slider">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#hero_slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.pexels.com/photos/1089030/pexels-photo-1089030.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                         class="d-block w-100" alt="...">

                    <div class="carousel_content_wrapper">
                        <div class="carousel-body">
                            <h4 class="display-4">Fotoğraf Makineleri</h4>
                            <p class="lead">Yeni yıl indirimleriyle, fotoğraf makinelerinde 50%'ye varan tasarruf
                                fırsatını kaçırma!</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/2251206/pexels-photo-2251206.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                         class="d-block w-100" alt="...">
                    <div class="carousel_content_wrapper">
                        <div class="carousel-body">
                            <h4 class="display-4">Televizyon Fırsatları</h4>
                            <p class="lead">16K televizyonlara 20% indirim fırsatı ile televizyonunu yenile!</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://images.pexels.com/photos/1714208/pexels-photo-1714208.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                         class="d-block" alt="...">
                    <div class="carousel_content_wrapper">
                        <div class="carousel-body">
                            <h4 class="display-4">Bilgisayarını Güncelle</h4>
                            <p class="lead">En kaliteli bilgisayar aksesuarları en uygun fiyatlarla!</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#hero_slider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hero_slider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>


    <section id="section_productList" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">

                    <div>
                        <h2 class="display-6">Yeni Ürünler</h2>
                    </div>

                    <div>
                        <select name="" id="" class="form-select">
                            <option value="">En Yeniler</option>
                            <option value="">En Çok Satanlar</option>
                            <option value="">En Çok Yorum Alanlar</option>
                            <option value="">En Çok Beğenilenler</option>
                        </select>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row row-cols-1 row-cols-md-3 row-gap-3">
                <?php foreach ($products as $product) { ?>
                    <div class="col">
                        <div class="card">
                            <div class="p-1 p-md-5 mb-5" style="max-height: 300px;">
                                <img src="<?= $product->imgURL ?>" class="card-img-top" alt="<?=$product->title?>"
                                     style="width: 100%; height: 100%;">
                            </div>
                            <div class="card-body mt-3">
                                <h5 class="card-title">
                                    <a href="<?= BASE_URL ?>urun/<?= createSlug($product->title) ?>"
                                       class="link-dark text-decoration-none">
                                        <?= substr($product->title, 0, 30) ?>...
                                    </a>
                                </h5>
                            </div>

                            <div class="card-footer text-center p-3">
                                <a href="#" class="btn btn-dark w-100 btn-lg">Sepete Ekle</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>


<style>
    .hero_slider {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100vh;
    }

    img {
        width: 100%;
        height: 100%;
    }

    .carousel-item::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
    }

    .carousel-item {
        position: relative;
    }

    .carousel_content_wrapper {
        position: absolute;
        display: flex;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 99999999;
        pointer-events: none;
    }

    .carousel-body {
        position: absolute;
        z-index: 999999;
        padding: 3rem;
        border-radius: 1rem;
        background-color: rgba(255, 255, 255, .8);
        text-align: center;
    }

    @media (max-width: 960px) {
        .carousel-body {
            padding: 0.25rem;
            top: 40%;
        }

        .carousel-body h1 {
            font-size: 1.25rem;
        }

        .carousel-body p {
            font-size: .825rem;
        }

        .carousel-body a {
            font-size: 0.75rem;
        }
    }


    .navbar {
        background-color: rgba(255, 255, 255, 0.8) !important;
        width: 100% !important;
        position: absolute !important;
        z-index: 999 !important;
    }

</style>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
