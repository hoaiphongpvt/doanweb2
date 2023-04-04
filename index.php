<?php 
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cửa hàng điện thoại di động The PS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo-banner/logotheps.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css.map">
    <link rel="stylesheet" href="assets/css_js/base.css">
    <link rel="stylesheet" href="assets/css_js/main.css">
    <link rel="stylesheet" href="assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/css_js/style.js"></script>
</head>
<body>
    <div class="app">
        <header class="header">
            <div class="grid">
                <nav class="header_navbar">
                    <ul class="header__navbar--list">
                        <li class="list-item list-item-separate">
                            <a href="index.php" class="list-item-iconlink">Trang chủ</a>
                        </li>
                        <li class="list-item">
                            <span class="list-item-title">Liên hệ</span>
                            <a href="https://www.facebook.com/" class="list-item-iconlink">
                                <i  class="ti-facebook list-item-icon"></i>
                            </a>
                            <a href="https://www.google.com/gmail/" class="list-item-iconlink">
                                <i  class="ti-email list-item-icon"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="header__navbar--list">
                        <li class="list-item">
                            <a href="aboutus.php" class="list-item-iconlink">
                                <i class="ti-info list-item-icon"></i>
                                Giới thiệu
                            </a>
                        </li>
                        <a class="list-item list-item-bold list-item-separate" onclick="showDangKi()">Đăng kí</a>
                        <a class="list-item list-item-bold" onclick="showDangNhap()">Đăng nhập</a>
                    </ul>
                </nav>
               <div class="header_with-search">
                   <div class="header__logo">
                    <a href="index.php"><img src="assets/img/logo-banner/logotheps.png" class="header__logo-img"></a>
                   </div>
                   <div class="header_search">
                        <?php include "./assets/components/search.php"?>
                    </div>
                 <div class="header_cart">
                    <a href="#" onclick="login_required()" style="text-decoration: none;"><i class="header_cart-icon ti-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
        </header>
        <!-- <header class="header2">
            <div class="grid">
                <nav class="brand">
                    <ul class="list_brand">
                        <li class="list_brand-item"><a href="#apple"><i class="ti-apple"></i> APPLE</a></li>
                        <li class="list_brand-item"><a href="#samsung">SAMSUNG</a></li>
                        <li class="list_brand-item"><a href="#xiaomi">XIAOMI</a></li>
                        <li class="list_brand-item"><a href="#oppo">OPPO</a></li>
                        <li class="list_brand-item"><a href="#vivo">VIVO</a></li>
                    </ul>
                 </nav>
            </div>
        </header> -->
        <div class="container">
           <div class="grid">
               <div class="content">
                    <div id="banner">
                        <img src="./assets/img/logo-banner/s23-banner.png" id="banner-img">
                   </div>
                </div>
                <?php include "./assets/components/loc.php"?>
                <div id="apple">
                    <div class="phone-heading">
                        <h3 class="phone-heading-text">Tất cả sản phẩm</h3>
                    </div>
                    <div class="phone-content">
                        
                        <?php
                            include "./assets/components/formatCurrency.php";
                            
                            $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
                            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                            $offset = ($current_page - 1) * $item_per_page;

                            $sql = "SELECT * FROM sanpham INNER JOIN chitietsanpham ON sanpham.ID = chitietsanpham.ID_SP ORDER BY 'sanpham.ID' ASC LIMIT ".$item_per_page." OFFSET ".$offset;
                            $result = $conn->query($sql);
                            $totalProducts = mysqli_query($conn, "SELECT * FROM sanpham");

                            $numRow = $totalProducts->num_rows;
                            $totalPages = ceil($numRow / $item_per_page);

                            while($row = $result->fetch_assoc()) {
                                $item = "<div class='phone-phone-item'>";
                                $item .= "<a href='chitietsanpham.php?id=".$row['ID']."'><img src=".$row["HINHANH"]." class='phone-img'></a>";
                                $item .= "<p  class='phone-name'><a href='chitietsanpham.php?id=".$row['ID']."'>".$row["TEN"]."</a></p>";
                                $item .= "<h3 class='phone-price'>".currency_format($row["GIA"]) ."</h3>";
                                $item .= "<div class='phone-vote'><p class='value'>".$row["DANHGIA"]."</p><i class='ti-star'></i></div>";
                                $item .= "<ul class='phone-parameter'>
                                    <li>Màn hình:" .$row["TS_MANHINH"]."</li>
                                    <li>Chip:" .$row["CHIP"]."</li>
                                    <li>Bộ nhớ: ".$row["TS_BONHO"]."</li>
                                    <li>Sim:" .$row["SIM"]."</li>
                                    <li>Pin: ".$row["TS_PIN"]."</li>
                                    </ul>";
                                $item .= "</div>";
                                echo $item;                                    
                            }
                        ?>
                        
                    </div>
                <?php include "./assets/components/phantrang.php"?>
             </div>
        </div>
    </div>
    <?php require "./assets/components/footer.php"?>
    <script src="./assets/slider/banner.js"></script>
    <script src="./assets/js/timkiem.js"></script>
    <script src="./assets/js/loc.js"></script>
    
    <div id="dangki" style="display: none;">
        <div class="modal">
            <div class="modal_overlay"></div>
            <div class="modal_body">    
            <div class="auth-form">
                    <div class="auth-form__container">
                        <div class="auth-form__header">
                            <h3 class="auth-form__heading">Đăng kí</h3>
                        </div>
                        <div class="auth-form__form">
                            <div class="auth-form__group">
                                <input type="text" class="auth-form__input" placeholder="Tên đăng nhập">
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" placeholder="Mật khẩu">
                            </div>
                            <div class="auth-form__group">
                                <input type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                            </div>
                        </div>
                        <div class="auth-form__note">
                            <input type="checkbox" class="auth-form__policy-check">
                            <p class="auth-form__policy-text">Tôi đồng ý với các điều khoản và dịch vụ.</p>
                        </div>
                        <div class="auth-form__controls">
                            <button class="btn btn--back" onclick="hide()">TRỞ LẠI</button>
                            <button class="btn btn--primary" onclick="DangKiThanhCong()">ĐĂNG KÍ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Dang nhap -->
    <div id="dangnhap" style="display: none;">
        <div class="modal">
            <div class="modal_overlay"></div>
                <div class="modal_body">   
                    <div class="auth-form">
                        <div class="auth-form__container">
                            <div class="auth-form__header">
                                    <h3 class="auth-form__heading">Đăng nhập</h3>
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group">
                                    <input type="text" class="auth-form__input" placeholder="Tên đăng nhập">
                                </div>
                            <div class="auth-form__group">
                                    <input type="password" class="auth-form__input" placeholder="Mật khẩu">
                            </div>
                        </div>
                        <div class="auth-form__note">
                            <p class="auth-form__policy-text2">Quên mật khẩu?</p>
                        </div>
                        <div class="auth-form__controls">
                            <button class="btn btn--back" onclick="hide()">TRỞ LẠI</button>
                            <button class="btn btn--primary" ><a href="demo/dangnhap.html" style="color: white; text-decoration: none;">ĐĂNG NHẬP</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Yeu cau dang nhap-->
    <div id="login_required" style="display: none;">
        <div class="modal">
            <div class="modal_overlay"></div>
            <div class="modal_body">    
                <div class="auth-form">
                    <div class="auth-form__container">
                        <div class="cart-icon-check">
                           <div  style="background-color: #cb1c22; border: 10px solid #cb1c22;"><i class="ti-alert"></i></div>
                        </div>
                        <div class="cart-notification">
                            <p>Vui lòng đăng nhập!</p>
                        </div>
                        <div class="cart-button-OK">
                            <button class="btn btn--primary" onclick="hide_login_required()">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>