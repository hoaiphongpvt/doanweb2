<?php 
    require "connect.php";
    include "./assets/components/formatCurrency.php";

    if (isset($_GET['id'])) {
        $productId = $_GET['id'];
        $sql = "SELECT sanpham.*, chitietsanpham.* FROM sanpham JOIN chitietsanpham ON sanpham.ID = chitietsanpham.ID_SP WHERE sanpham.id=".$productId;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    } else {
        echo "Error";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thông tin chi tiết <?php echo $row['TEN']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo-banner/logotheps.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css.map">
    <link rel="stylesheet" href="./assets/css_js/base.css">
    <link rel="stylesheet" href="./assets/css_js/main.css">
    <link rel="stylesheet" href="assets/css_js/responsive.css">
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="./assets/css_js/style.js"></script>
    
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
                        <?php 
                           include "./assets/components/dangnhapvadangxuat.php";
                        ?> 
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

                        <?php 
                            if ($user) {
                                echo '<a href="giohang.php" style="text-decoration: none;">
                                        <i class="header_cart-icon ti-shopping-cart"></i>
                                    </a>';
                            } else {
                                echo '<span onclick="alert(\'Vui lòng đăng nhập\')">
                                        <i class="header_cart-icon ti-shopping-cart"></i>
                                    </span>';
                            }
                        ?>
                    </div>

                    <div class="option" id="menu">
                        <a href="#">
                            <i class="header-menu ti-menu"></i>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <header class="mobile-header">
            <!-- Overlay -->
            <div class="menu-overlay" id="menu-overlay"></div>
            <div class="menu-drawer" id="menu-drawer">
                <a href="#!"><img src="./assets/img/logo-banner/logotheps.png" alt="Besnik." class="logo-mobile"></a>
                <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="https://www.facebook.com/">Liên hệ</a></li>
                    <li><a href="aboutus.php">Giới thiệu</a></li>
                    <?php 
                        if ($user) {
                            echo '<li><a href="giohang.php">Giỏ hàng</a></li>';
                        } else {
                            echo '<span onclick="alert(\'Vui lòng đăng nhập\')">
                                    <a>Giỏ hàng</a>
                                </span>';
                        }
                    ?>
                    <li class="saperate"></li>
                    <?php 
                        include "./assets/components/dangnhapvadangxuat.php";
                    ?> 
                </ul>
            </div>
        </header>
        <div class="container-product">
            <div class="grid">
                <!-- <div id="banner">
                    <img src="./assets/apple/img/banner-product.png" id="banner-img">
                </div> -->
                <div class="name-product">
                    <p><?php echo $row['TEN']?></p>
                </div>
                <div class="general-infomation">
                    <div class="img-product">
                        <img src=<?php echo $row["HINHANH"]?> class="phone-img-product"> 
                    </div>
                    <div class="info">
                        <div class="option-product">
                            <div class="price-product">
                                <span>Giá cực sốc:</span>
                                <p><?php echo currency_format($row["GIA"])?></p>
                            </div>
                            </div>
                            <div class="add-to-cart">
                                <?php 
                                    if($user) {
                                        echo '<form method="POST" action="giohang.php?idsanpham='.$row["ID"].'">
                                                <button onclick="addToCart()" type="submit" name="themgiohang" class="btn-add-to-cart">THÊM VÀO GIỎ HÀNG</button>
                                            </form>';
                                    } else {
                                        echo '<button onclick="login_required()" class="btn-add-to-cart">THÊM VÀO GIỎ HÀNG</button>';
                                    }
                                ?>
                                
                            </div>
                            <div class="buy-now">
                                <button class="btn-buy-now" onclick="alert('Chức năng đang trong quá trình phát triển!')">MUA NGAY</button>
                            </div>
                        </div>
                    </div>

                <div class="detailed-configuration">
                        <div class="detailed-configuration-info">
                            <h3>Cấu hình điện thoại <?php echo $row["TEN"]?></h3>
                            <ul class="detailed-configuration-info-list">
                                <li>Hệ điều hành: <?php echo $row["HDH"]?></li>
                                <li>Màn hình: <?php echo $row["TS_MANHINH"]?></li>
                                <li>Chip: <?php echo $row["CHIP"]?></li>
                                <li>Sim: <?php echo $row["SIM"]?></li>
                                <li>Camera: <?php echo $row["TS_CAMERA"]?></li>
                                <li>Bộ nhớ: <?php echo $row["TS_BONHO"]?></li>
                                <li>Pin: <?php echo $row["TS_PIN"]?></li>
                            </ul>
                        </div>
                        <div class="detailed-configuration-img">
                            <img src=<?php echo $row["ANHTHONGSO"]?> width="100%">
                        </div>
                    </div>
                    <div class="review">

                </div>
                <div class="review">
                    <h3 class="desc_title">Đánh giá chi tiết <?php echo $row["TEN"]?></h3>
                    <p class="desc_detail"><?php echo $row["MOTA"]?></p>
                </div>
            </div>
        </div>
        <?php require "./assets/components/footer.php"?>
    </div>
    <script src="./assets/js/timkiem.js"></script>
    <?php include "./assets/components/yeucaudangnhap.php"?>
     <!-- Mua ngay -->
     <div id="order" style="display: none;">
        <div class="modal">
            <div class="modal_overlay"></div>
                <div class="modal_body">   
                    <div class="auth-form">
                        <div class="auth-form__container">
                            <div class="order-header">
                                    <div class="order-img">
                                        <img src="../../assets/apple/img/iphone-13-pro-max-gold-1-200x200.jpg" alt="">
                                    </div>
                                    <div class="order-text">
                                        <span>Điện thoại iPhone 13 Pro Max</span>
                                        <p>Bộ nhớ: 128GB</p>
                                        <p>Màu: Vàng</p>
                                    </div>
                            </div>
                            <div class="auth-form__form">
                                <div class="order-info">
                                    <span>THÔNG TIN KHÁCH HÀNG</span>
                                    <div class="order-choose-gender">
                                        <p><input type="radio" name="gender" style="vertical-align: middle; margin: 0px 5px;">Anh</p>
                                        <p><input type="radio" name="gender"  style="vertical-align: middle; margin: 0px 5px;">Chị</p>
                                    </div>
                                </div>
                                <div class="auth-form__group">
                                    <input type="text" class="auth-form__input" placeholder="Họ và Tên">
                                </div>
                                <div class="auth-form__group">
                                        <input type="number" class="auth-form__input" placeholder="Số điện thoại">
                                </div>
                                <div class="auth-form__group">
                                    <input type="text" class="auth-form__input" placeholder="Địa chỉ">
                                </div>
                                <div class="order-total">
                                    <p class="order-total-text">Tổng tiền:</p>
                                    <p class="order-total-price">32.990.000đ</p>
                                </div>
                            </div>
                        <div class="auth-form__controls">
                            <button class="btn btn--back" onclick="hide_cart()">TRỞ LẠI</button>
                            <button class="btn btn--primary" onclick="DatHangThanhCong()">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/slider/banner.js"></script>
    <script src="./assets/js/menuMobile.js"></script>
</body>
</html>