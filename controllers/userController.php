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

$router->get('hesabim/adreslerim', function () {
    loadView('user/account-addresses', 'Adreslerim');
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