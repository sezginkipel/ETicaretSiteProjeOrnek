<?php require_once BASE_DIRECTORY . 'views/admin/_components/header.php' ?>

<?php
global $db;
$getProducts = $db->prepare("SELECT * FROM product ORDER BY id DESC LIMIT 18");
$getProducts->execute();
$products = $getProducts->fetchAll(PDO::FETCH_OBJ);
?>


<section id="dashboard" class="mt-5 mb-5">
    <div class="container">
        <div class="stats">
            <div class="row">
                <div class="col-3">STAT 1</div>
                <div class="col-3">STAT 2</div>
                <div class="col-3">STAT 3</div>
                <div class="col-3">STAT 4</div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
