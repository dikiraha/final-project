<?php
if (isset($_POST['submit'])) {
    $token = "BtPvgC8xZUwYc8rQSeGBfxK8XKppEnSdDU8HKuZdfBqB9fDMUx";
    $nomor = $_POST['nomor'];
    $isi = $_POST['pesan'];
    $message = sprintf("----------AISINBISA----------%c$isi%c------------------------- ", 10, 10);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://app.ruangwa.id/api/send_message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'token=' . $token . '&number=' . $nomor . '&message=' . $message,
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    echo "<script>toastr.success('Pesan WhatsApp telah dikirim ke $nomor')</script>";
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Kirim Pesan WhatsApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #dbf5ff;
            padding: 10px;
        }
    </style>
</head>

<body class="body">
    <h2>Kirim Pesan WhatsApp</h2>
    <form method="post" action="">
        <div class="form-group mb-3">
            <label for="nomor">Nomor Telepon:</label><br>
            <input type="text" id="nomor" name="nomor" required class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="pesan">Pesan:</label><br>
            <textarea id="pesan" name="pesan" required class="form-control"></textarea>
        </div>
        <div class="form-group mb-3">
            <input type="submit" name="submit" value="Kirim Pesan" class="btn btn-success">
        </div>



    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "closeButton": true
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>