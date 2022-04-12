<?php
require("condb.php");
$id = $_GET["id"];

$sql = "

                    SELECT  
                   
                        rs.riskstore_id, 
                        rs.riskstore_name, 
                        m.member_name, 
                        t.`name`, 
                        g.program_name, 
                        tt.team_name, 
                        s.status_name, 
                        i.inform_name,
                        r.id,
                        rg.id_risk,
                        r.date_report,
                        r.time_report,
                        d.duration_name,
                        l.`name`,
                        dm.depart_name,
                        r.detail,
                        r.problem_basic,
                        ll.level_name,
                        r.edit,
                        r.affected,
                        i.inform_name,
                        r.status_risk,
                        m.member_name,
                        r.modify_date,
                        r.create_date,
						rg.send_use,
						rg.register_date,
                        dm.depart_name,
                        rg.repeat_code,
                        lw.warning_name
                                                        

                    FROM 
                        risk r
                        LEFT OUTER JOIN riskstore rs ON rs.riskstore_id = r.riskstore_id
                        LEFT OUTER JOIN inform i ON i.id = r.inform_id
                        LEFT OUTER JOIN type t ON t.id = rs.type_id
                        LEFT OUTER JOIN program g ON g.program_id = rs.program_id
                        LEFT OUTER JOIN team tt ON tt.id = rs.team_id
                        LEFT OUTER JOIN `status` s ON s.id = rs.`status`
                        LEFT OUTER JOIN member m ON m.cid = rs.member_cid
                        LEFT OUTER JOIN riskregister rg ON   rg.id = r.id
                        LEFT OUTER JOIN duration d     ON    d.id = r.duration_id
                        LEFT OUTER JOIN location l     ON    l.id = r.location_id
                        LEFT OUTER JOIN department  dm ON    dm.id = r.user_ir
                        LEFT OUTER JOIN `level` ll		ON    ll.level_code = r.level_id
                        LEFT OUTER JOIN levelwarning lw ON lw.warning_code = rg.repeat_code
                        WHERE r.id = $id
                    ORDER BY rs.riskstore_id
                        ";

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
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">


    <div class="container" style=" width:100%; padding-top: 20px;" align="left">
        <div class="riskregister-view">
            <form class="form-vertical">
                <div id="w1" class="kv-view-mode">
                    <div class="kv-detail-view table-responsive">
                        <table id="w1" class="table table-hover table-bordered table-striped detail-view" 
                            data-krajee-kvDetailView="kvDetailView_351a9e3e">
                            <tr class="success">
                                <th colspan="2"><span class="glyphicon glyphicon-bookmark" aria-hidden="true">
                                    </span>
                                    ความเสี่ยงที่ได้จากการรายงานและผ่านการยืนยันจาก
                                    คณะกรรมการ RM แล้ว สามารถนำไปใช้งานและอ้างอิงได้
                                </th>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width:20%; padding-right: 30px;">ID Register/ID Risk</th>
                                            <td style="width:20%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['id']; ?>
                                                        <?php echo $row['id_risk']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 20%;">วันที่เวลารายงาน</th>
                                            <td style="width: 20%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['date_report']; ?>
                                                        <?php echo $row['time_report']; ?>น.
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 10%">เวรที่เกิด</th>
                                            <td style="width:10%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['duration_name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">สถานที่พบเหตุ</th>
                                            <td style="width:50%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">แผนกที่รายงานถึง</th>
                                            <td style="width:30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['depart_name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th
                                                style="width: 20%; text-align: left; vertical-align: middle; padding-right: 30px;">
                                                โปรแกรมความเสี่ยง</th>
                                            <td style="width:30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['program_name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">ชื่อความเสี่ยง</th>
                                            <td style="width:30%">
                                                <div class="kv-attribute"><span style="color:blue;">
                                                        <font size="2">
                                                            <?php echo $row['riskstore_name']; ?>
                                                        </font>
                                                    </span></div>
                                            </td>
                                            <th style="width: 20%; text-align: left; vertical-align: middle;">
                                                ระดับความรุนแรง</th>
                                            <td style="width:30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['level_name']; ?>
                                                    </font>
                                                </div>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">เหตุการณ์/รายละเอียดเพิ่มเติม?</th>
                                            <td style="width: 60%">
                                                <div class="kv-attribute"><span class="text-justify"><em>
                                                            <font size="2">
                                                                <?php echo $row['detail']; ?>
                                                            </font>
                                                        </em></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">วิธีแก้ปัญหาเบื้องต้น</th>
                                            <td style="width: 60%">
                                                <div class="kv-attribute"><span class="text-justify"><em>
                                                            <font size="2">
                                                                <?php echo $row['problem_basic']; ?>
                                                            </font>
                                                        </em></span></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">ภาพถ่าย</th>
                                            <td style="width: 85%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['riskstore_id']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">การแก้ปัญหา</th>
                                            <td style="width: 30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['edit']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 20%; text-align: left; vertical-align: middle;padding-right: 20px;">
                                                ผู้เสียหาย/ได้รับผลกระทบ
                                            </th>
                                            <td style="width: 50%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['affected']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%; text-align: left; vertical-align: middle;padding-right: 20px;">ที่มาของรายงานความเสี่ยง</th>
                                            <td style="width: 30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['inform_name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 20%; text-align: left; vertical-align: middle;padding-right: 20px;">
                                                สถานะความเสี่ยง</th>
                                            <td style="width: 30%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['status_risk']; ?>
                                                    </font>
                                                </div>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 10%; text-align: left; vertical-align: middle;padding-right: 20px;">รายงานโดย</th>
                                            <td style="width: 15%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['member_name']; ?>
                                                    </font>
                                                </div>

                                            </td>
                                            <th style="width: 15%">แผนกที่รายงาน</th>
                                            <td style="width:20%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['depart_name']; ?>
                                                    </font>
                                                </div>

                                            </td>
                                            <th style="width: 10%">วันที่บันทึก</th>
                                            <td style="width:20%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['create_date']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="info">
                                <th colspan="2"><span class="glyphicon glyphicon-check" aria-hidden="true"></span>
                                    รายละเอียดการลงทะเบียน,การยืนยันความเสี่ยง
                                    และการส่งความเสี่ยงไปยังผู้รับผิดชอบเพื่อทบทวนและแก้ปัญหาต่อไป...</th>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 10%; text-align: left; vertical-align: middle;padding-right: 20px;">
                                                วันที่ส่งข้อมูล</th>
                                            <td style="width:15%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['modify_date']; ?>
                                                    </font>
                                                </div>

                                            </td>
                                            <th style="width: 10%">วันที่ลงทะเบียน</th>
                                            <td style="width:10%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['register_date']; ?>
                                                    </font>
                                                </div>

                                            </td>
                                            <th style="width: 10%">ผู้ลงทะเบียน</th>
                                            <td style="width:7%">
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['send_use']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 15%">ระดับการทบทวน</th>
                                            <td style="width:30%">
                                                <div class="kv-attribute">
                                                    <span class='badge' style='background-color:#ff0000 ' align='left'>
                                                    </span>
                                                    <code>
                                                            <font size="2">
                                                                <?php echo $row['repeat_code']; ?>
                                                            </font>
                                                            <font size="2"><br>
                                                                <?php echo $row['warning_name']; ?>
                                                            </font>
                                                        </code>
                                                </div>
                                                <div class="kv-form-attribute" style="display:none">
                                                    <div
                                                        class="form-group highlight-addon field-riskregister-repeat_code required">
                                                        <div>
                                                            <!--[if lt IE 10]>
<input type="text" id="riskregister-repeat_code" class="spectrum-input form-control" name="Riskregister[repeat_code]" value="RV1">
<br><div class="alert alert-warning">It is recommended you use an upgraded browser to display the text control properly.</div>
<![endif]-->
                                                            <![if gt IE 9]>
                                                            <div
                                                                class="spectrum-group input-group input-group-html5 kv-type-text is-bs3">
                                                                <span id="riskregister-repeat_code-cont"
                                                                    class="kv-center-loading input-group-sp input-group-addon"><input
                                                                        type="text" id="riskregister-repeat_code-source"
                                                                        class="spectrum-source form-control-text"
                                                                        name="riskregister-repeat_code-source"
                                                                        value="RV1" style="display:none"></span><input
                                                                    type="text" id="riskregister-repeat_code"
                                                                    class="spectrum-input form-control"
                                                                    name="Riskregister[repeat_code]" value="RV1">
                                                            </div>
                                                            <![endif]>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%">Note</th>
                                            <td>
                                                <div class="kv-attribute"><span class="text-justify"><em></em></span>
                                                </div>
                                                <div class="kv-form-attribute" style="display:none">
                                                    <div class="form-group highlight-addon field-riskregister-note">
                                                        <div><textarea id="riskregister-note" class="form-control"
                                                                name="Riskregister[note]" rows="4"></textarea>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="kv-child-table-row">
                                <td class="kv-child-table-cell" colspan=2>
                                    <table class="kv-child-table">
                                        <tr>
                                            <th style="width: 20%; text-align: left; vertical-align: middle;">
                                                ส่งหน่วยงาน</th>
                                            <td>
                                                <div class="kv-attribute">
                                                    <font size="2">
                                                        <?php echo $row['depart_name']; ?>
                                                    </font>
                                                </div>
                                            </td>
                                            <th style="width: 10%">ส่งทีมนำ</th>
                                            <td style="width:20%">
                                                <div class="kv-attribute"><span class="not-set">(ไม่ได้ตั้ง)</span>
                                                </div>
                                                <div class="kv-form-attribute" style="display:none"></div>
                                            </td>
                                            <th style="width: 10%">ส่ง CEO รพ.</th>
                                            <td style="width:20%">
                                                <div class="kv-attribute"><span class="not-set">(ไม่ได้ตั้ง)</span>
                                                </div>
                                                <div class="kv-form-attribute" style="display:none"><span
                                                        class="not-set">(ไม่ได้ตั้ง)</span></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
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





</body>

</html>