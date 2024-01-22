<?php require_once BASE_DIRECTORY . 'views/_components/header.php' ?>

<section id="contact">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="">
                    <div class="mb-3">
                        <h1>Bizimle İletişime Geçin</h1>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Ad Soyad</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ad Soyad">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-Posta Adresi">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mesajınız</label>
                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
