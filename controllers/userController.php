<?php
$router = new Router();

$router->get('giris', function () {
    loadView('user/signin', 'Kullanıcı Girişi');
});

$router->get('kaydol', function () {
    loadView('user/signup', 'Hesap Oluştur');
});

$router->get('hesabim', function () {
    loadView('user/account', 'Hesabım');
});

$router->get('hesabim/duzenle', function () {
    loadView('user/account-edit', 'Hesabımı Düzenle');
});

/*| Kullanıcı adres bilgileri |*/
$router->get('hesabim/adreslerim', function () {
    loadView('user/account-addresses', 'Adreslerim');
});

$router->post('hesabim/adreslerim/adres/sil', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $addressId = removeSpecialChars($reqData->addressId);

    $deleteAddress = $db->prepare('DELETE FROM addresses WHERE id = ?');
    if ($deleteAddress->execute([$addressId])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Adres başarıyla silindi.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Adres silinirken bir hata oluştu.']);
    }
});

$router->post('hesabim/adreslerim/adres/guncelle', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $customerId = $_SESSION['user']->id;
    $addressId = removeSpecialChars($reqData->addressId);
    $addressTitle = removeSpecialChars($reqData->addressTitle);
    $customerName = removeSpecialChars($reqData->customerName);
    $addressDetails = removeSpecialChars($reqData->addressDetails);
    $city = removeSpecialChars($reqData->city);
    $postCode = removeSpecialChars($reqData->postCode);
    $phoneNumber = removeSpecialChars($reqData->phoneNumber);
    $email = removeSpecialChars($reqData->email);

    $updateAddress = $db->prepare('UPDATE addresses SET title = ?, customerName = ?, addressDetails = ?, city = ?, postCode = ?, phoneNumber = ?, email = ? WHERE id = ? AND customerId = ?');
    if ($updateAddress->execute([$addressTitle, $customerName, $addressDetails, $city, $postCode, $phoneNumber, $email, $addressId, $customerId])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Adres başarıyla güncellendi.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Adres güncellenirken bir hata oluştu.']);
    }
});

$router->post('hesabim/adreslerim/adres/ekle', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $customerId = $_SESSION['user']->id;
    $addressTitle = removeSpecialChars($reqData->addressTitle);
    $customerName = removeSpecialChars($reqData->customerName);
    $addressDetails = removeSpecialChars($reqData->addressDetails);
    $city = removeSpecialChars($reqData->city);
    $postCode = removeSpecialChars($reqData->postCode);
    $phoneNumber = removeSpecialChars($reqData->phoneNumber);
    $email = removeSpecialChars($reqData->email);

    $addAddress = $db->prepare('INSERT INTO addresses (customerId, title, customerName, addressDetails, city, postCode, phoneNumber, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    if ($addAddress->execute([$customerId, $addressTitle, $customerName, $addressDetails, $city, $postCode, $phoneNumber, $email])) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Adres başarıyla eklendi.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Adres eklenirken bir hata oluştu.']);
    }
});

/*| Kullanıcı hesabı bilgileri |*/
$router->post('hesabim/guncelle', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $customerId = $_SESSION['user']->id;
    $username = removeSpecialChars($reqData->username);
    $email = removeSpecialChars($reqData->email);
    $password = $reqData->password;

    if ($password == '' || $password == null || $password == false || strlen($password) <= 3 || empty($password)) {
        $passwordHash = $_SESSION['user']->passwordHash;
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }

    $updateCustomer = $db->prepare('UPDATE users SET username = ?, email = ?, passwordHash = ? WHERE id = ?');
    if ($updateCustomer->execute([$username, $email, $passwordHash, $customerId])) {
        $_SESSION['user']->username = $username;
        $_SESSION['user']->email = $email;
        $_SESSION['user']->passwordHash = $passwordHash;
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Hesap bilgileri başarıyla güncellendi.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Hesap bilgileri güncellenirken bir hata oluştu.']);
    }

});


$router->get('hesabim/iletisim-bilgilerim', function () {
    loadView('user/account-contact', 'İletişim Bilgilerim');
});

$router->get('cikis', function () {
    session_destroy();
    header('Location: ' . BASE_URL);
});


$router->post('giris', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $email = $reqData->email;
    $password = $reqData->password;

    $checkUser = $db->prepare('SELECT * FROM users WHERE email = :email');
    $checkUser->bindParam(':email', $email);
    $checkUser->execute();

    $userInfo = $checkUser->fetch(PDO::FETCH_OBJ);

    if ($checkUser->rowCount() > 0) {
        if (password_verify($password, $userInfo->passwordHash)) {
            $response = ['status' => 'success', 'message' => 'Giriş başarılı!'];
            header('Content-Type: application/json');
            $_SESSION['user'] = $userInfo;
            echo json_encode($response);
        } else { // Parola hatalı
            $response = ['status' => 'error', 'message' => 'E-posta ya da parola hatalı! Tekrar deneyin'];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else { // Kullanıcı yoksa
        $response = ['status' => 'error', 'message' => 'E-posta ya da parola hatalı! Tekrar deneyin'];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
});

$router->post('kaydol', function () {
    global $db;
    $reqData = json_decode(file_get_contents('php://input'));

    $email = $reqData->email;
    $username = $reqData->username;
    $password = $reqData->password;

    $checkUser = $db->prepare('SELECT * FROM users WHERE email = :email');
    $checkUser->bindParam(':email', $email);
    $checkUser->execute();

    if ($checkUser->rowCount() > 0) {
        $response = ['status' => 'error', 'message' => 'Bu e-posta adresi ile daha önce kayıt olunmuş!'];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $addUser = $db->prepare('INSERT INTO users (email, username, passwordHash) VALUES (:email, :username, :passwordHash)');
        $addUser->bindParam(':email', $email);
        $addUser->bindParam(':username', $username);
        $addUser->bindParam(':passwordHash', $passwordHash);
        $addUser->execute();

        $response = ['status' => 'success', 'message' => 'Kayıt başarılı!'];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
});