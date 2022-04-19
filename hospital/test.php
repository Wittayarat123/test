<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>โรงพยาบาลวังเจ้า อ.วังเจ้า จ.ตาก</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/BG.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/stylev1.css" rel="stylesheet">


    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap" rel="stylesheet">
    
   

</head>

<body>
    <section>
        <div class="container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">รับสมัครงาน</button>
                </div>
            </nav>
            <?php
                require_once('db/connect.php');

                $sql = " SELECT * FROM tb_new 
                WHERE new_name LIKE '%รับสมัคร%'
                ORDER BY new_id DESC LIMIT 5 
                        ";
                $result = $connect->query($sql);
                ?>


            <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <!--1 --><br>
                    <i class="fa fa-calendar"></i>
                    <font class="style3"><?php echo $row['new_date']; ?></font>
                    &nbsp; <a href="?page=news_detail&new_id=1360"><b>
                            <?php echo $row['new_name']; ?>
                        </b>
                    </a>

                    <?php endwhile ?>
                </div>
            </div>
        </div>
    </section>


    <!-- ======= Footer ======= -->
    <footer class="text-light bg-dark">
        <div class="container d-md-flex py-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <p>Wangchao Hospital</p>
                        <p>
                            โรงพยาบาลชุมชน
                            เพื่อชุมชน เพื่อสุขภาพดี</p>
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <!-- <h6>Categories</h6>
                <ul class="footer-links">
                    <li><a href="http://scanfcode.com/category/c-language/">C</a></li>
                    <li><a href="http://scanfcode.com/category/front-end-development/">UI Design</a></li>
                    <li><a href="http://scanfcode.com/category/back-end-development/">PHP</a></li>
                    <li><a href="http://scanfcode.com/category/java-programming-language/">Java</a></li>
                    <li><a href="http://scanfcode.com/category/android/">Android</a></li>
                    <li><a href="http://scanfcode.com/category/templates/">Templates</a></li>
                </ul> -->
                    </div>

                    <div class="col-xs-6 col-md-3">
                        <h6>Quick Links</h6>
                        <ul class="footer-links">
                            <li><a href="index.php">หน้าหลัก</a></li>
                            <li><a href="history.php">ประวัติความมาโรงพยาบาล</a></li>
                            <li><a href="person.php">ทำเนียบผู้บริหาร</a></li>
                            <li><a href="_blank.php">ข่าวล่าสุด</a></li>
                            <li><a href="contact.php">ติดต่อเรา</a></li>
                            <li><a href="intercom.php">ค้นหาเบอร์ภายใน</a></li>
                        </ul>
                    </div>
                </div>
                <hr>

                <div class="credits">
                    Designed by <a href="https://www.facebook.com/wittayarat123">JokeMoo</a>
                    <p>Copyright ©2022 Wangchao Hospital.</p>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->


    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>