<?php require_once BASE_DIRECTORY . 'views/_components/header.php'; ?>

<?php
if(isset($_SESSION['user'])){
    header('Location: '.BASE_URL);
}
?>

<section id="user_signin">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-12 col-md-4 mt-5 p-5 bg-light rounded-1 shadow-sm">
                <form action="<?= BASE_URL ?>giris" method="post" id="form_signin">
                    <div class="mb-3">
                        <h2 class="text-center">Giriş Yap</h2>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Parola</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Giriş Yap</button>

                    <div class="mt-3">
                        <span>Hesabınız yok mu? <a href="<?= BASE_URL ?>kaydol" class="text-dark"> Kaydolun</a></span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form_signin = document.getElementById('form_signin');

    form_signin.addEventListener('submit', function(event) {
        event.preventDefault();

        let emailValue = document.getElementById('email').value;
        let passwordValue = document.getElementById('password').value;

        let formData = {
            email: emailValue,
            password: passwordValue
        }

        let formBody = JSON.stringify(formData);
        let requestURL = '<?=BASE_URL?>giris';

        fetch(requestURL, {
            method: 'post',
            body: formBody,
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Giriş Başarılı',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 2500
                    }).then(() => {
                        window.location.href = '<?=BASE_URL?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Giriş Başarısız',
                        text: data.message,
                        showConfirmButton: true,
                        timer: 2500
                    });
                }
            })
    });
</script>