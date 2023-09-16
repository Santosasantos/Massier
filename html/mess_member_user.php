<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>

<?php
// session_start();
include "../php/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>

<body>
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
                        <a href="" class="active">
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
                </nav>
            </div>
        </div>
    </div>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <label for="">

                    </label>
                </div>
                <?php include "navbar.php"; ?>
            </div>



        </header>
        <main>
            <div class="page-content">
                <div class="text-container" style="text-align:center;">
                    <h1>Welcome,</h1>
                    <h2>your mess id: 1</h2>
                </div>
                <div class="table-container" style="text-align: center;
        margin: 0 auto;
        width: 50%; 
        padding-top: 10px;">
                    <table class="table table-borderless " style="margin: 0 auto; text-align:left;">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $messid = $_SESSION['mess_info']['mess_id'];
                            $email = $_SESSION['login_info']['email'];

                            $sql = "SELECT ua.name,mm.email FROM mess_members mm JOIN user ua ON mm.email = ua.email WHERE mm.mess_id = $messid AND mm.email != '$email'";
                            $res = $conn->query($sql);

                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo '<tr>
                   <td>' . $row["name"] . '</td>
                   <td>' . $row["email"] . '</td>
                 </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
</body>

</html>