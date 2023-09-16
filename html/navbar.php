<?php

include '../php/connect.php';


function number_suffix($number)
{
	$ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
	if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
		return $number . 'th';
	} else {
		return $number . $ends[$number % 10];
	}
}

$notifications = [];
$current_date = date("Y-m-d");
$one_day_after = date("Y-m-d", strtotime("-1 day", strtotime($current_date)));

$sql = "SELECT * FROM user WHERE DATE_FORMAT(dob, '%m-%d') = DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 1 DAY), '%m-%d')";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
	while ($row = $res->fetch_assoc()) {

		if ($row['email'] === $_SESSION['login_info']['email']) {
		} else {

			$age = (date("Y") - date("Y", strtotime($row["dob"]))) + 1;
			//if ($_SESSION['login_info']['dob'] != $one_day_after) 
			{
				$notifications[] = "<i class='fa fa-bell'></i> Tomorrow is <b>{$row["name"]}</b>'s " . number_suffix($age) . " Birthday. Date of birth is <b>" . date("d-m-Y", strtotime($row["dob"])) . "</b>";
			}
		}
	}
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="collapse navbar-collapse bg-light" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					<span class='fa fa-bell'></span>(<?php echo count($notifications); ?>)
				</a>
				<?php if (count($notifications) > 0) : ?>
					<div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="navbarDropdown">
						<?php foreach ($notifications as $row) : ?>
							<a class="dropdown-item pt-3 pb-3 alert alert-success" href="#"><?php echo $row; ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="logout.php">Logout</a>
			</li>
		</ul>
	</div>
</nav>