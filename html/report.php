<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>



<?php
include '../php/connect.php';
$_SESSION['selected_email']=$_SESSION['login_info']['email'];
include '../php/calculation.php';
// ... Your existing PHP code ...
$_SESSION['mess_info']['mess_id'];

// Fetch member data
$query = "SELECT 
    m.email AS MemberEmail,
    u.name AS MemberName,
    (SELECT 
        SUM(lunch + breakfast + dinner) 
        FROM meal 
        WHERE email = m.email 
        AND date BETWEEN '$start_date' AND '$end_date') AS TotalMeal,
    (SELECT SUM(amount) 
        FROM balance 
        WHERE email = m.email 
        AND date BETWEEN '$start_date' AND '$end_date' 
        AND balance_type = 'meal') AS TotalDeposit,
        (SELECT IFNULL(SUM(amount), 0) FROM cost WHERE mess_id = '1' AND date BETWEEN '$start_date' AND '$end_date' AND type = 'others') AS TotalCost
FROM mess_members AS m
INNER JOIN user AS u ON m.email = u.email
WHERE m.mess_id = '$mess_id'";

$result = mysqli_query($conn, $query);

// Initialize an array to store member data
$memberDataArray = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $memberDataArray[] = [
            'MemberEmail' => $row['MemberEmail'],
            'MemberName' => $row['MemberName'],
            'TotalMeal' => $row['TotalMeal'],
            'TotalDeposit' => $row['TotalDeposit'],
            'TotalCost' => $row['TotalCost']+($row['TotalMeal']*$meal_rate),
            'Balance' => $row['TotalDeposit']-($row['TotalCost']+($row['TotalMeal']*$meal_rate)),
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.0/html2pdf.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="html2pdf.bundle.min.js"></script>
    <style>
    body{
        margin: 20px;
    }
    table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div id="month-info">

   
    <h1 style="text-align: center; color:brown">Active Month Details</h1>
    <h3 style="text-align: center;">Month title: <?php echo date('F Y');?></h3>
    <p>Mess Name: <?php echo $_SESSION['mess_info']['mess_name']?></p>
    <p>Mess Balance: <?php echo $manager_balance_meal + $manager_balance_month;?></p>
    <p>Mess Total Meal: <?php echo $total_meal;?></p>
    <p>Mess Total Deposit: <?php echo $total_deposite_meal + $total_deposite_month;?></p>
    <p>Mess Total Meal Cost: <?php echo ($total_meal * $meal_rate);?></p>
    <p>Mess Meal rate: <?php echo $meal_rate;?></p>
    <p>Mess Total Cost (Meal + other): <?php echo ($total_meal * $meal_rate) + $total_cost_from_other;?></p>
    <h2 style="color:brown;">Member Summary Info</h2>
    <table border="1">
        <thead>
            <tr>
                <td>Member Email</td>
                <td>Member Name</td>
                <td>Total Meal</td>
                <td>Total Deposit</td>
                <td>Total Cost</td>
                <td>Balance</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberDataArray as $member) { ?>
                <tr>
                    <td><?php echo $member['MemberEmail'];?></td>
                    <td><?php echo $member['MemberName'];?></td>
                    <td><?php echo $member['TotalMeal'];?></td>
                    <td><?php echo $member['TotalDeposit'];?></td>
                    <td><?php echo $member['TotalCost'];?></td>
                    <td><?php echo $member['Balance'];?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    </div>
    <div class="text-center mt-4">
        <button type="button" class="btn btn-primary" onclick="generatePDF()">Download PDF</button>
    </div>
<script>
   function generatePDF() {
    const elmnt = document.getElementById("month-info");
    const currentDate = new Date();
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const currentMonth = monthNames[currentDate.getMonth()];
    const messName = "<?php echo $_SESSION['mess_info']['mess_name'];?>"; 
    const filename = `${messName}_${currentMonth}_Report.pdf`;
    const pdfOptions = {
        margin: 1,
        filename: filename,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
    };

    html2pdf()
        .from(elmnt)
        .set(pdfOptions)
        .save();
}

</script>

</body>
</html>
