<?php require_once BASE_DIRECTORY . 'views/admin/_components/header.php' ?>

<?php
global $db;

$getCategories = $db->prepare("SELECT * FROM categories");
$getCategories->execute();
$categories = $getCategories->fetchAll(PDO::FETCH_OBJ)
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"
        integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<section id="dashboard" class="mt-5 mb-5">
    <div class="container">
        <div class="stats">
            <div class="row justify-content-center">
                <div class="col-6 mb-3">
                    <h1 class="text-center">Ürün Ekle</h1>
                    <hr>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <form action="" method="post" id="form_addProduct">

                        <div class="mb-3">
                            <label for="">Ürün Başlığı</label>
                            <input type="text" id="product_title" name="product_title" class="form-control"
                                   placeholder="Ürün başlığı" required>
                        </div>

                        <div class="mb-3">
                            <label for="">Ürün Fiyatı</label>
                            <input type="text" id="product_price" name="product_price" class="form-control"
                                   placeholder="Ürün fiyatı" required>
                        </div>

                        <div class="mb-3">
                            <label for="">Ürün Görseli</label>
                            <div class="productImg_imgUrl">
                                <input type="text" id="product_img" name="product_img" class="form-control"
                                       placeholder="Ürün görseli bağlantısı" required>
                                <button type="button" class="btn btn-sm btn-outline-dark mt-2" id="uploadProductImageButton">Dosya Yükle</button>
                            </div>

                            <div id="productImg_uploadFile" style="display: none">
                                <input type="file" id="product_imgFile" name="product_imgFile" class="form-control" required>
                                <div class="form-text">Ürün görseli yüklemek için tıklayın.</div>
                                <button type="button" class="btn btn-sm btn-outline-dark mt-2" id="enterImageURLButton">Görsel Bağlantısı Gir</button>
                            </div>

                            <script>
                                const enterImageURLButton = document.querySelector('#enterImageURLButton');
                                const uploadProductImageButton = document.querySelector('#uploadProductImageButton');

                                const productImg_imgUrl = document.querySelector('.productImg_imgUrl');
                                const productImg_uploadFile = document.querySelector('#productImg_uploadFile');

                                enterImageURLButton.addEventListener('click', () => {
                                    productImg_imgUrl.style.display = 'block';
                                    productImg_uploadFile.style.display = 'none';
                                });

                                uploadProductImageButton.addEventListener('click', () => {
                                    productImg_imgUrl.style.display = 'none';
                                    productImg_uploadFile.style.display = 'block';
                                });
                            </script>

                        </div>

                        <div class="mb-3">
                            <label for="">Ürün Kategorisi</label>
                            <select name="product_category" id="product_category" class="form-select">
                                <option value="0" disabled selected>Kategori Seçin</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id ?>"><?= $category->title ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <textarea id="default" name="description" placeholder="Ürün açıklaması"></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Ürün Ekle</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    const product_imgFile = document.querySelector('#product_imgFile');
    const product_img = document.querySelector('#product_img');

    product_imgFile.addEventListener('change', (e) => {
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append('product_imgFile', file);

        let postURL = '<?= BASE_URL . 'yonetim-paneli/urunler/gorsel-yukle' ?>';
        console.log(formData);

        fetch(postURL, {
            method: 'POST',
            body: formData
        })


            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    product_img.value = data.fileUrl;
                    Swal.fire({
                        icon: 'success',
                        title: 'Ürün Görseli Yüklendi',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 5000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bir Hata Oluştu',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 5000
                    });
                }
            })
    });
</script>







<script>
    tinymce.init({
        selector: 'textarea#default',
        plugins: 'advlist link image lists'
    });


    const form_addProduct = document.querySelector('#form_addProduct');

    form_addProduct.addEventListener('submit', (e) => {
        e.preventDefault();

        let product_title = document.querySelector('#product_title').value;
        let product_price = document.querySelector('#product_price').value;
        let product_img = document.querySelector('#product_img').value;
        let product_category = document.querySelector('#product_category').value;
        let product_description = tinymce.get('default').getContent();

        console.log(product_description);

        let formData = {
            product_title,
            product_price,
            product_img,
            product_category,
            product_description
        }

        let postURL = '<?= BASE_URL . 'yonetim-paneli/urunler/ekle' ?>';

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
                        title: 'Ürün Eklendi',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '<?=BASE_URL?>yonetim-paneli/urunler';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Bir Hata Oluştu',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 5000
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
