<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<?php
global $db;
$productSlug = @getParams()[1];
$getProduct = $db->prepare("SELECT * FROM products WHERE slug = :slug");
$getProduct->bindParam(':slug', $productSlug);
$getProduct->execute();

if ($getProduct->rowCount() == 0) {
    header('Location: ' . BASE_URL);
}

$product = $getProduct->fetch(PDO::FETCH_OBJ);
?>
<section id="categories">
    <div class="container mt-5 mb-5 bg-light p-5 rounded-3 shadow overflow-dhidden">
        <div class="row row-cols-2 row-gap-3">
            <div class="col">
                <img src="<?= $product->imgURL ?>" alt="<?= $product->name ?>" class="img-fluid">
            </div>

            <div class="col">
                <h1 class="fs-3"><?= $product->title ?></h1>
                <hr>
                <p class="fs-3 fw-bold">Fiyat: <?= $product->price ?>₺</p>

                <div class="col-12 col-md-8 mt-5">
                    <form action="<?= BASE_URL ?>urun/sepete-ekle" id="form_addProductToCart">
                        <input type="hidden" id="product_id" name="product_id" value="<?= $product->id ?>">

                        <div class="mb-3 input-group">
                            <span class="input-group-text bg-dark text-light">Adet</span>
                            <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="10"
                                   value="1">
                            <button class="btn btn-dark" type="submit" id="addToCartBtn">Sepete Ekle</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <hr>
                <h2 class="fs-3">Ürün Açıklaması</h2>
                <hr>
            </div>
            <div class="col-12">
                <span>
                    <?= (str_replace(['<pre>', '</pre>', '<script>'], '', nl2br(htmlspecialchars_decode($product->description)))) ?>
                </span>
            </div>
        </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    const form_addProductToCart = document.querySelector('#form_addProductToCart');

    form_addProductToCart.addEventListener('submit', (e) => {
        e.preventDefault();

        let productId = document.querySelector('#product_id').value;
        let productQuantity = document.querySelector('#quantity').value;

        let formData = {
            productId: productId,
            productQuantity: productQuantity
        }

        let postURL = '<?= BASE_URL ?>urun/sepete-ekle';

        fetch(postURL, {
            method: 'POST',
            body: JSON.stringify(formData),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ürün Sepete Eklendi',
                        text: data.message,
                        showConfirmButton: true
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bir Hata Oluştu',
                        text: data.message,
                        showConfirmButton: true
                    });
                }
            })
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
