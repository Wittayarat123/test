<?php
require_once("condb.php");
isset( $_POST['search'] ) ? $search = $_POST['search'] : $search = "";
$p = '%'.$search.'%';
$sql = "
                    SELECT  
                        rs.*, 
                        rs.riskstore_id, 
                        rs.riskstore_name, 
                        m.member_name, 
                        t.`name`, 
                        g.program_name, 
                        tt.team_name, 
                        s.status_name, 
                        i.inform_name,
                        r.*,
                        r.id,
                        rg.id_risk,
                        r.date_report
                    FROM 
                        risk r
                        LEFT OUTER JOIN riskstore rs ON rs.riskstore_id = r.riskstore_id
                        LEFT OUTER JOIN inform i ON i.id = rs.inform_id
                        LEFT OUTER JOIN type t ON t.id = rs.type_id
                        LEFT OUTER JOIN program g ON g.program_id = rs.program_id
                        LEFT OUTER JOIN team tt ON tt.id = rs.team_id
                        LEFT OUTER JOIN `status` s ON s.id = rs.`status`
                        LEFT OUTER JOIN member m ON m.cid = rs.member_cid
                        LEFT OUTER JOIN riskregister rg ON   rg.id = r.id
                     where rs.riskstore_name like '%$p%'
                     ORDER BY rs.riskstore_id";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>riskhospital</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />

    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    </style>

</head>

<body>
    <div class="container">
        <h2>ค้นหาข้อมูล</h2>
        <form action="test.php" method="post">
            <label>หัวข้อความเสี่ยง</label><input type="text" size="40px" name="search" />
            <input name="submit" type="submit" id="submit" value="ค้นหาข้อมูล">
        </form>
        <table id="myTable" class="table table-striped">
            <thead>
                <tr class="table-dark">
                    <td> ID</td>
                    <td>ชื่อความเสี่ยง</td>
                    <td>โปรแกรมความเสี่ยง</td>
                    <td>ทีมนำ</td>
                    <td>ระดับ</td>
                    <td>ผู้รับผิดชอบ</td>
                </tr>
            </thead>
            <?php 
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                
        ?>
            <tr>
                <td><?php echo $row['riskstore_id']; ?></td>
                <td><?php echo $row['riskstore_name']; ?></td>
                <td><?php echo $row['program_name']; ?></td>
                <td><?php echo $row['team_name']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['member_name']; ?></td>

            </tr>
            <?php
        } 
        ?>
        </table>
    </div>




</body>

</html>