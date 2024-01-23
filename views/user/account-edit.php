<?php require_once BASE_DIRECTORY . 'views/_components/header.php'; ?>

<?php
global $db;

if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'giris');
} else {
    $user = $_SESSION['user'];
}


$orderQuery = $db->prepare('SELECT * FROM orders WHERE customerID = :customerID');
$orderQuery->bindParam(':customerID', $user->id);
$orderQuery->execute();

$orders = $orderQuery->fetchAll(PDO::FETCH_OBJ);
?>

<section id="user_account">
    <div class="container mt-5">

        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    Hoş geldiniz: <strong><?= $user->username ?></strong>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-3">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim">Siparişlerim</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>hesabim/duzenle">Bilgilerimi
                            Güncelle</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim/adreslerim">Adreslerim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim/iletisim-bilgilerim">İletişim Bilgilerim</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-9">
                <form action="<?= BASE_URL ?>hesabim/guncelle" method="post" id="form_editCustomer">
                    <div class="mb-3">
                        <label for="username" class="form-label">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?= $user->username ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-Posta Adresi</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Parola</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Parolanızı değiştirmek istemiyorsanız bu alanı boş bırakın.</small>
                    </div>

                    <button type="submit" class="btn btn-dark">Güncelle</button>
                </form>
            </div>
        </div>

    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const formEditCustomer = document.querySelector('#form_editCustomer');

    formEditCustomer.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = {
            username: document.querySelector('#username').value,
            email: document.querySelector('#email').value,
            password: document.querySelector('#password').value
        };

        fetch('<?=BASE_URL?>hesabim/guncelle', {
            method: 'POST',
            body: JSON.stringify(formData)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı!',
                        text: data.message,
                        showConfirmButton: true,
                        confirmButtonText: 'Tamam',
                        timer: 2500
                    })
                        .then(() => {
                            window.location.reload();
                        });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
