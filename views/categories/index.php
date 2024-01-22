<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$getCategories = $db->prepare("SELECT * FROM categories");
$getCategories->execute();
$categories = $getCategories->fetchAll(PDO::FETCH_OBJ);
?>
<section id="categories">
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 row-gap-3">

            <?php foreach ($categories as $category){ ?>
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?=$category->title?></h5>
                        <p class="card-text"><?=$category->description?></p>
                        <a href="<?=BASE_URL?>kategori/<?=createSlug($category->title)?>" class="btn btn-outline-dark w-100 mt-4">Ürünleri Gör</a>
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
