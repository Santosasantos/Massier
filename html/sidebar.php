<input type="checkbox" id="menu-toggle">
<div class="sidebar">


    <div class="side-header">
        <h3><img src="../assets/images/m.png" height="25px" width="25px"><span>assier</span></h3>
    </div>

    <div class="side-content">


        <!-- crown -->
        <div class="profile">
            <div class="profile-img-wrapper">
                <div class="profile-img bg-img" style="background-image: url(../assets/images/profile.webp);background-position: center;"></div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') : ?>
                    <i class="las la-crown" style="color: gold;"></i>
                <?php endif; ?>
            </div>
            <h4><?php echo $_SESSION["login_info"]["name"]; ?></h4>
        </div>


        <div class="side-menu">



            <ul>
                <li>
                    <a href="homepage_html.php">
                        <span class="las la-home"></span>
                        <small>Home Page</small>
                    </a>
                </li>
                <li>
                    <a href="<?php

                                if (isset($_SESSION['role'])) {

                                    if ($_SESSION['role'] === "manager") {
                                        echo 'mess_member_manager.php';
                                    } else {
                                        echo 'mess_member_user.php';
                                    }
                                }
                                ?>">
                        <span class="las la-users"></span>
                        <small>Mess</small>
                    </a>
                </li>

                <li>
                <a href="report.php">
                        <span class="las la-clipboard-list"></span>
                        <small>Report</small>
                    </a>
                </li>


            </ul>

        </div>
    </div>
</div>