<?php


require('vendor/autoload.php'); // include 
use Zxing\QrReader;

$msg = "";
if(isset($_POST['upload'])){
    $filename = $_FILES['qrCode']['name'];
    $filetype = $_FILES['qrCode']['type'];
    $filetemp = $_FILES['qrCode']['tmp_name'];
    $filesize = $_FILES['qrCode']['size'];

    $filetype = explode("/",$filetype);

    if($filetype[0] !== "image"){
        $msg = "File type is invalied : " . $filetype;
    }elseif($filesize > 5242880){
        $msg = "File size too big. Mazimum size is 5 MB";
    }else{
        $newfilename = md5(rand() . time()) . $filename;
        move_uploaded_file($filetemp,"uploads/" . $newfilename);
    }
    $qrScan = new QrReader("uploads/".$newfilename);
    $msg = "QR Code is scanned the reuslt is :" . $qrScan->text();
}

?>
<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">

    <title> QR Code  قارئ </title>
  </head>
  <body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mx-auto">
                <div class="card card-body p-5 rounded border bg-white">
                    <h1 class="mb-4 text-center">  قارئ QR </h1>
                    <?= $msg; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="qrCode" class="form-label"> قم برفع الصورة  </label>
                        <input type="file" class="form-control" id="qrCode" name="qrCode" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary" name="upload"> تحقق </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
