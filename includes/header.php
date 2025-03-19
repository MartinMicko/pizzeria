
<?php
if (session_status() === 1) {
    session_start();
    
}






?>

<div class="navbar">
    <div class="logo">
        <a href="home.php"><img src="./img/logo.png" height="75.5" width="140.5" alt="" ></a>
    </div>
    <nav>
        <ul id="MenuItems">
        
            <?php if (isset($_SESSION['id'])) :  ?>
                <?php if (($_SESSION['id']===1)) :  ?>
                <li><a href="admin.php">Admin</a></li>
            <?php endif; ?>
            <?php endif; ?>
            
            <li><a href="home.php">HOME</a></li>
            <li><a href="products.php">MENU</a></li>
            <li><a href="about.php">ABOUT US</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a href="tracking.php">TRACKING</a></li>

            

        </ul>
    </nav>
    <a href="cart.php"><img src="./img/cart.png" width="30px" height="30px" alt=""></a>
    <img src="./img/menu.png" class="menu-icon" onclick="menutoggle()">
</div>