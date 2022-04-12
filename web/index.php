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


</head>


<body onload="myFunction()" style="margin:0;">

    <!--******************Navbar******************-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%">
        <div class="container-fluid">
            <!--******************Icon Wangchao Hospital******************-->
            <a class="navbar-brand" href="index.php">
                <img src="http://wangchaohosp.go.th/images/icon/logo.png">
            </a>
            <!--******************Icon Hospital******************-->
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-hospital">
                    <path
                        d="M8.5 5.034v1.1l.953-.55.5.867L9 7l.953.55-.5.866-.953-.55v1.1h-1v-1.1l-.953.55-.5-.866L7 7l-.953-.55.5-.866.953.55v-1.1h1ZM13.25 9a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM13 11.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Zm.25 1.75a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5Zm-11-4a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5A.25.25 0 0 0 3 9.75v-.5A.25.25 0 0 0 2.75 9h-.5Zm0 2a.25.25 0 0 0-.25.25v.5c0 .138.112.25.25.25h.5a.25.25 0 0 0 .25-.25v-.5a.25.25 0 0 0-.25-.25h-.5ZM2 13.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5Z" />
                    <path
                        d="M5 1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1V1Zm2 14h2v-3H7v3Zm3 0h1V3H5v12h1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3Zm0-14H6v1h4V1Zm2 7v7h3V8h-3Zm-8 7V8H1v7h3Z" />
                </svg>
                WANGCHAO HOSPITAL RISK
            </a>
        </div>
    </nav>

    <!--******************loader******************-->
    <div id="loader" class="lds-ellipsis" >
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!--<div id="loader"></div> -->
    
    <div style="display:none;" id="myDiv" class="animate-bottom">

        <!--******************loader******************-->
        <div class="container">
            <h2 class=" text-center" style="padding-top: 25px;padding-bottom: 25px;">Risk Store</h2>
        </div>




        <!--******************DATA TABLE******************-->
        <div class="container">
            <table id="myTable" class="table table-striped" style="width: 100%;" background="BG.png">
                <thead>
                    <tr class="table-dark">
                        <td> ID</td>
                        <td>ชื่อความเสี่ยง</td>
                        <td>โปรแกรมความเสี่ยง</td>
                        <td>ทีมนำ</td>
                        <td>ระดับ</td>
                        <td>ผู้รับผิดชอบ</td>
                        <td>แก้ไขข้อมูล</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                require_once('condb.php');

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

                    ORDER BY rs.riskstore_id
                        ";

                $result = $connect->query($sql);
                ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td align="center" valign="middle">
                            <font size="2"><?php echo $row['riskstore_id']; ?></font>
                        </td>
                        <td valign="middle">

                            <font size="2"><?php echo $row['riskstore_name']; ?></font>
                        </td>
                        <td valign="middle">
                            <font size="2"><?php echo $row['program_name']; ?></font>
                        </td>
                        <td valign="middle">
                            <font size="2"><?php echo $row['team_name']; ?></font>
                        </td>
                        <td valign="middle">
                            <font size="2"><?php echo $row['name']; ?></font>
                        </td>
                        <td valign="middle">
                            <font size="2"><?php echo $row['member_name']; ?></font>
                        </td>
                        <td align="center" valign="middle">
                            <a href="edit.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-outline-success btn-sm"  target="_blank">ดูรายละเอียด</a>
                        </td>

                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--******************loader******************-->
    <script>
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 3000);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
    </script>

    <!--******************SEARCH******************-->
    <script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
    </script>






</body>


</html>