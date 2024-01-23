<?php require_once BASE_DIRECTORY . 'views/_components/header.php'; ?>

<?php
global $db;

if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . 'giris');
} else {
    $user = $_SESSION['user'];
}

$getAddresses = $db->prepare('SELECT * FROM addresses WHERE customerId = :customerId');
$getAddresses->bindParam(':customerId', $user->id);
$getAddresses->execute();
$addresses = $getAddresses->fetchAll(PDO::FETCH_OBJ);
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
                        <a class="nav-link" aria-current="page" href="<?= BASE_URL ?>hesabim/duzenle">Bilgilerimi
                            Güncelle</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="<?= BASE_URL ?>hesabim/adreslerim">Adreslerim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>hesabim/iletisim-bilgilerim">İletişim Bilgilerim</a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-md-9">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h1 class="fs-3">Adreslerim</h1>
                        <button class="btn btn-dark" onclick="addNewAddress()">Adres Ekle</button>
                    </div>
                </div>
                <hr>

                <div class="row row-cols-1 row-gap-3">
                    <?php foreach ($addresses as $address) { ?>
                        <div class="col">
                            <div class="card">
                                <h5 class="card-header"><?= $address->title ?></h5>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= $address->customerName ?>
                                    </h5>
                                    <p class="card-text"><?= $address->addressDetails ?></p>
                                    <small class="card-text"><?= $address->city ?></small>
                                    /
                                    <small class="card-text"><?= $address->postCode ?></small>
                                </div>

                                <div class="card-footer">
                                    <button type="button"
                                            onclick="updateUserAddress<?= $address->id ?>(<?= $address->id ?>)"
                                            class="btn btn-warning">Adresi Düzenle
                                    </button>

                                    <button type="button" onclick="deleteUserAddress(<?= $address->id ?>)"
                                            class="btn btn-danger">Adresi Sil
                                    </button>
                                </div>
                            </div>

                            <script>
                                const updateUserAddress<?=$address->id?> = async (addressId) => {
                                    const {value: formValues} = await Swal.fire({
                                        title: "Adresi Düzenle",
                                        html: `
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-warning" role="alert">
                                                    Adresinizi düzenlemek için lütfen bilgilerinizi giriniz.
                                                </div>
                                                <div class="col-6 p-3">
                                            <input id="input_title" class="swal2-input w-100" value="<?=$address->title?>" placeholder='Adres Başlığı'>
                                            <input id="input_customerName" class="swal2-input w-100" value="<?=$address->customerName?>" placeholder='Ad ve Soyad'>
                                            <input id="input_address" class="swal2-input w-100" value="<?=$address->addressDetails?>" placeholder='Adres'>
                                            <input id="input_city" class="swal2-input w-100" value="<?=$address->city?>" placeholder='Şehir'>
                                            <input id="input_postCode" class="swal2-input w-100" value="<?=$address->postCode?>" placeholder='Posta Kodu'>
                                            <input id="input_phoneNumber" class="swal2-input w-100" value="<?=$address->phoneNumber?>" placeholder='Telefon Numarası'>
                                            <input id="input_email" class="swal2-input w-100" value="<?=$address->email?>" placeholder='E-posta Adresi'>
                                            <input id="input_customerId" class="swal2-input w-100" value="<?=$address->customerId?>" hidden>
                                                 </div></div>`,
                                        confirmButtonText: `Adresi Kaydet`,
                                        showCancelButton: true,
                                        cancelButtonText: "Vazgeç",
                                        width: 700,
                                        preConfirm: () => {
                                            return [
                                                {
                                                    addressTitle: document.getElementById("input_title").value,
                                                    customerName: document.getElementById("input_customerName").value,
                                                    addressDetails: document.getElementById("input_address").value,
                                                    city: document.getElementById("input_city").value,
                                                    postCode: document.getElementById("input_postCode").value,
                                                    phoneNumber: document.getElementById("input_phoneNumber").value,
                                                    emailaddr: document.getElementById("input_email").value,
                                                    customerId: document.getElementById("input_customerId").value,
                                                    addressId: addressId
                                                }
                                            ];
                                        }
                                    });
                                    if (formValues) {
                                        let formData = {
                                            addressTitle: formValues[0].addressTitle,
                                            customerName: formValues[0].customerName,
                                            addressDetails: formValues[0].addressDetails,
                                            city: formValues[0].city,
                                            postCode: formValues[0].postCode,
                                            phoneNumber: formValues[0].phoneNumber,
                                            email: formValues[0].emailaddr,
                                            customerId: formValues[0].customerId,
                                            addressId: formValues[0].addressId
                                        }

                                        let postURL = '<?= BASE_URL ?>hesabim/adreslerim/adres/guncelle';

                                        fetch(postURL, {
                                            method: 'POST',
                                            body: JSON.stringify(formData),
                                            headers: {
                                                'Content-Type': 'application/json'
                                            }
                                        }).then(response => response.json())
                                            .then(data => {
                                                if (data.status === 'success') {
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Adres Güncellendi!',
                                                        text: data.message,
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    }).then(() => {
                                                        window.location.reload();
                                                    })
                                                } else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Hata!',
                                                        text: data.message,
                                                        showConfirmButton: false,
                                                        timer: 1500
                                                    })
                                                }
                                            })
                                    }
                                }
                            </script>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteUserAddress = (addressId) => {
        let formData = {
            addressId: addressId
        }

        let postURL = '<?= BASE_URL ?>hesabim/adreslerim/adres/sil';


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Adresi Silmek İstediğinize Emin Misiniz?",
            text: "Bu işlem geri alınamaz!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Evet, sil!",
            cancelButtonText: "Hayır, iptal et!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(postURL, {
                    method: 'POST',
                    body: JSON.stringify(formData),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Adres Silindi!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Hata!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
            }
        });
    }
</script>


<script>
    const addNewAddress = async () => {
        const {value: formValues} = await Swal.fire({
            title: "Adres Ekle",
            html: `
                                        <div class="row w-75">
                                            <div class="col-12">
                                                <input id="input_title" class="swal2-input w-100" placeholder='Adres Başlığı'>
                                                <input id="input_customerName" class="swal2-input w-100" placeholder='Ad ve Soyad'>
                                                <input id="input_address" class="swal2-input w-100" placeholder='Adres'>
                                                <input id="input_city" class="swal2-input w-100" placeholder='Şehir'>
                                                <input id="input_postCode" class="swal2-input w-100" placeholder='Posta Kodu'>
                                                <input id="input_phoneNumber" class="swal2-input w-100" placeholder='Telefon Numarası'>
                                                <input id="input_email" class="swal2-input w-100" placeholder='E-posta Adresi'>
                                            </div>
                                        </div>`,
            confirmButtonText: `Adresi Kaydet`,
            showCancelButton: true,
            cancelButtonText: "Vazgeç",
            preConfirm: () => {
                return [
                    {
                        addressTitle: document.getElementById("input_title").value,
                        customerName: document.getElementById("input_customerName").value,
                        addressDetails: document.getElementById("input_address").value,
                        city: document.getElementById("input_city").value,
                        postCode: document.getElementById("input_postCode").value,
                        phoneNumber: document.getElementById("input_phoneNumber").value,
                        emailaddr: document.getElementById("input_email").value
                    }
                ];
            }
        });
        if (formValues) {
            let formData = {
                addressTitle: formValues[0].addressTitle,
                customerName: formValues[0].customerName,
                addressDetails: formValues[0].addressDetails,
                city: formValues[0].city,
                postCode: formValues[0].postCode,
                phoneNumber: formValues[0].phoneNumber,
                email: formValues[0].emailaddr
            }

            let postURL = '<?= BASE_URL ?>hesabim/adreslerim/adres/ekle';

            fetch(postURL, {
                method: 'POST',
                body: JSON.stringify(formData),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Adres Eklendi!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
