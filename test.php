<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ปรับ REG</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap">

  <style>
    /* General table styles */

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    /* Responsive styles */
    @media screen and (max-width: 600px) {

      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        margin: 0 0 1rem 0;
      }

      tr:nth-child(odd) {
        background: #f2f2f2;
      }

      td {
        border: none;
        border-bottom: 1px solid #ddd;
        position: relative;
        padding-left: 10px;
        /* Adjust padding for input fields */
        padding-top: 10px;
        padding-bottom: 20px;
        /* Add padding to separate from the label */
        text-align: left;
        display: flex;
        /* Use flexbox to stack label and input vertically */
        flex-direction: column;
        align-items: flex-start;
      }

      td::before {
        content: attr(data-label);
        font-weight: bold;
        margin-bottom: 5px;
        /* Adds space between the label and input */
      }
    }

    label {
      display: inline-block;
      margin-right: 10px;
    }

    textarea {
      width: calc(100% - 120px);
      /* ปรับขนาด textarea ให้พอดีกับข้อความ */
      height: auto;
      vertical-align: top;
    }

    /* General styles for action buttons */
    /* General styles for action buttons */
    .action-btn {
      display: inline-block;
      padding: 8px 16px;
      font-size: 14px;
      font-family: 'K2D', sans-serif;
      color: #fff;
      background-color: #ffc107;
      /* Yellow for general action buttons */
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    /* Style for the save button */
    .action-btn.save-btn {
      background-color: #007bff;
      /* Blue for save */
    }

    .action-btn.save-btn:hover {
      background-color: #0056b3;
      /* Darker blue on hover */
    }

    /* Style for the delete button */
    .action-btn.delete-btn {
      background-color: #dc3545;
      /* Red for delete */
    }

    .action-btn.delete-btn:hover {
      background-color: #c82333;
      /* Darker red on hover */
    }



    .font-k2d {
      font-family: 'K2D', sans-serif;
    }
  </style>

</head>

<script>
  window.onload = function() {
    fetchDataTitle();
    fetchDataReason();
    fetchDataYear();
    fetchDataTb1();
    fetchDataIssue()
  };

  function fetchDataTitle() {
    var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
    var pid = urlParams.get('pid');
    // console.log(pid);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetchData.php?pid=' + pid, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var datatitle = JSON.parse(xhr.responseText);
        displayDataTitle(datatitle);
        // console.log(datatitle);
      }
    };
    xhr.send();
  }



  // ฟังก์ชันแสดงข้อมูลในตารางs
  function displayDataTitle(datatitle) {
    var output = '';
    if (datatitle.length > 0 || datatitle.length == "") {
      for (var i = 0; i < datatitle.length; i++) {
        output += '<tr class="border-b hover:bg-gray-50">';
        output += '<td class="py-2 px-4">' + datatitle[i].title + '</td>';
        output += '<td class="py-2 px-4 flex space-x-2">';
        output += '<button class="action-btn edit-btn" onclick="editDataTitle(' + datatitle[i].programId + ')">แก้ไข</button>';
        output += '<button class="action-btn delete-btn" onclick="clearTitleById(\'' + datatitle[i].programId + '\')">ลบ</button>';
        output += '</td>';
        output += '</tr>';
      }
    } else {
      output = '<tr><td colspan="2" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td></tr>';
    }
    document.getElementById('datatitle').innerHTML = output;
  }
</script>

<
  script>
  function fetchDataReason() {
  // console.log("oioivoi ");

  var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
  var pid = urlParams.get('pid');
  // console.log(pid);

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'fetchData.php?pid=' + pid, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
  xhr.onreadystatechange = function() {
  if (xhr.readyState == 4 && xhr.status == 200) {
  var datareason = JSON.parse(xhr.responseText);
  displayDataReason(datareason);

  }
  };
  xhr.send();
  }



  // ฟังก์ชันแสดงข้อมูลในตาราง
  function displayDataReason(reason) {
  var output = '';
  if (reason.length > 0) {
  for (var i = 0; i
  < reason.length; i++) {
    output +='<tr class="border-b hover:bg-gray-50">' ;
    output +='<td class="py-2 px-4">' + reason[i].reason + '</td>' ;
    output +='<td class="py-2 px-4 flex space-x-2">' ;
    output +='<button class="action-btn edit-btn" onclick="editDataReason(' + reason[i].programId + ')">แก้ไข</button>' ;
    output +='<button class="action-btn delete-btn" onclick="clearReasonById(' + reason[i].programId + ')">ลบ</button>' ;
    output +='</td>' ;
    output +='</tr>' ;
    }
    } else {
    output='<tr><td colspan="2" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td></tr>' ;
    }
    document.getElementById('datareason').innerHTML=output;
    }
    </script>


    <script>
      function fetchDataYear() {
        // console.log("oioivoi ");

        var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
        var pid = urlParams.get('pid');
        // console.log(pid);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'fetchData.php?pid=' + pid, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            var datayear = JSON.parse(xhr.responseText);
            displayDataYear(datayear);

          }
        };
        xhr.send();
      }
      // ฟังก์ชันแสดงข้อมูลในตาราง
      function displayDataYear(year) {
        var output = '';
        if (year.length > 0) {
          for (var i = 0; i < year.length; i++) {
            output += '<tr class="border-b hover:bg-gray-50">';
            output += '<td class="py-2 px-4">' + year[i].datayear + '</td>';
            output += '<td class="py-2 px-4 flex space-x-2">';
            output += '<button class="action-btn edit-btn" onclick="editDataYear(' + year[i].programId + ')">แก้ไข</button>';
            output += '<button class="action-btn delete-btn" onclick="clearYearById(' + year[i].programId + ')">ลบ</button>';
            output += '</td>';
            output += '</tr>';
          }
        } else {
          output = '<tr><td colspan="2" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td></tr>';
        }
        document.getElementById('datayear').innerHTML = output;
      }
    </script>


    <
      script>
      function fetchDataTb1() {

      var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
      var pid = urlParams.get('pid');
      // console.log(pid);

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetchDatatb1.php?pid=' + pid, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
      xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
      var tb1 = JSON.parse(xhr.responseText);
      displayDataTb1(tb1);

      }
      };
      xhr.send();
      }
      // ฟังก์ชันแสดงข้อมูลในตาราง
      function displayDataTb1(tb1) {
      var output = '';
      if (tb1.length > 0) {

      for (var i = 0; i
      <script tb1.length; i++) {
        // console.log(tb1[i]);

        // var edit='<button class="action-btn edit-btn btn btn-warning" onclick="editDataTb1(' + tb1[i].course + ')">แก้ไข</button>' ;
        output +='<tr class="border-b hover:bg-gray-50">' ;
        output +='<td class="py-2 px-4">' + tb1[i].course + '</td>' ;
        output +='<td class="py-2 px-4">' + tb1[i].old_normal + '</td>' ;
        output +='<td class="py-2 px-4">' + tb1[i].old_special + '</td>' ;
        output +='<td class="py-2 px-4">' + tb1[i].new_normal + '</td>' ;
        output +='<td class="py-2 px-4">' + tb1[i].new_special + '</td>' ;
        // เพิ่มคอลัมน์สำหรับปุ่มแก้ไข
        output +='<td class="py-2 px-4">' ;
        output +="<button class='action-btn edit-btn btn btn-warning' onclick='editDataTb1(" + tb1[i].id + ")'>แก้ไข</button>" ;
        output +='</td>' ;
        // เพิ่มคอลัมน์สำหรับปุ่มลบ
        output +='<td class="py-2 px-4">' ;
        output +="<button class='action-btn delete-btn btn btn-danger' onclick='clearTb1ById(" + tb1[i].id + ")'>ลบ</button>" ;
        output +='</td>' ;
        output +='</tr>' ;
        }
        } else {
        output='<tr><td colspan="8" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td></tr>' ;
        }
        document.getElementById('tb1').innerHTML=output;
        } </script>
        <
        script >
          function fetchDataIssue() {
            // console.log("oioivoi ");

            var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
            var pid = urlParams.get('pid');
            // console.log(pid);

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetchData.php?pid=' + pid, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
            xhr.onreadystatechange = function() {
              if (xhr.readyState == 4 && xhr.status == 200) {
                // console.log(xhr.responseText); // ดูว่าข้อมูลที่ได้รับเป็นอย่างไร
                var dataissue = JSON.parse(xhr.responseText);
                displayDataIssue(dataissue);
              }
            };
            xhr.send();
          }
        // ฟังก์ชันแสดงข้อมูลในตาราง
        function displayDataIssue(issue) {
          // console.log(issue[0].proposed_issue);

          var output = '';
          if (issue.length > 0) {
            for (var i = 0; i < issue.length; i++) {
              output += '<tr class="border-b hover:bg-gray-50">';
              output += '<td class="py-2 px-4">' + issue[i].proposed_issue + '</td>';
              // console.log(issue[i].proposed_issue);
              output += '<td class="py-2 px-4 flex space-x-2">';
              output += '<button class="action-btn edit-btn" onclick="editDataIssue(' + issue[i].programId + ')">แก้ไข</button>';
              output += '<button class="action-btn delete-btn" onclick="clearIssueById(' + issue[i].programId + ')">ลบ</button>';
              output += '</td>';
              output += '</tr>';
            }
          } else {
            output = '<tr><td colspan="2" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td></tr>';
          }
          document.getElementById('dataissue').innerHTML = output;
        }
      </script>



      <body class="hold-transition sidebar-mini">
        <div class="wrapper">
          <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav" style="font-family: 'K2D', sans-serif;">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
              </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Navbar Search -->
              <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                  <form class="form-inline">
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>


              <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
                </a>
              </li>

            </ul>
          </nav>
          <!-- /.navbar -->

          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
              <img src="../image/msu.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light" style="font-family: 'K2D', sans-serif;">ปรับ REG</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user (optional) -->


              <!-- SidebarSearch Form -->
              <div class="form-inline" style="font-family: 'K2D', sans-serif;">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item" style="font-family: 'K2D', sans-serif;">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-file-alt"></i>
                      <p>
                        หัวข้อแบบฟอร์ม
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="4_2page.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>การปรับแผนการรับนิสิตเข้าศึกษา</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="4_3page.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>การแก้ไขคำอธิบายรายวิชา</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="4_6page.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>การเปลี่ยนแปลงอาจารย์ผู้รับผิดชอบหลักสูตรและอาจารย์ประจำหลักสูตร</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
                </li>

                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">

                  <div class="col-sm-6" style="font-family: 'K2D', sans-serif;">
                    <h1 style="margin-top: 20px;">การปรับแผนการรับนิสิตเข้าศึกษา</h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                    <div class="card-body">
                      <div class="form-group">
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              ชื่อเรื่อง
                            </h3>
                          </div>
                          <div class="card-body">
                            <textarea id="title">
                </textarea>
                          </div>
                          <div class="card-body" style="text-align: right; margin-bottom: -1.25rem; margin-top: -2.5rem;">
                            <button type="button" class="btn btn-primary" id="saveTitle" style="font-family: 'K2D', sans-serif;">บันทึก</button>
                          </div>

                          <div class="card-body bg-white shadow-md rounded-lg">
                            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
                              <thead class='bg-gray-200 text-gray-600'>
                                <tr>
                                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                                </tr>
                              </thead>
                              <tbody id="datatitle">
                                <!-- ข้อมูลจะแสดงที่นี่ -->

                              </tbody>
                            </table>
                          </div>
                          <div class="card-footer">
                          </div>

                        </div>
                      </div>
                    </div>


                    <div class="card-body">
                      <div class="form-group">
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              หลักการและเหตุผล
                            </h3>
                          </div>
                          <div class="card-body">
                            <textarea id="reason">
                </textarea>
                          </div>
                          <div class="card-body" style="text-align: right; margin-bottom: -1.25rem; margin-top: -2.5rem;">
                            <button type="button" class="btn btn-primary" id="saveReason" style="font-family: 'K2D', sans-serif;">บันทึก</button>
                          </div>

                          <div class="card-body bg-white shadow-md rounded-lg">
                            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
                              <thead class='bg-gray-200 text-gray-600'>
                                <tr>
                                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                                </tr>
                              </thead>
                              <tbody id="datareason">
                                <!-- ข้อมูลจะแสดงที่นี่ -->

                              </tbody>
                            </table>
                          </div>
                          <div class="card-footer">
                          </div>

                        </div>
                      </div>
                    </div>



                    <div class="card-body">
                      <div class="form-group">
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              สาระการปรับปรุงแก้ไข
                            </h3>
                          </div>
                          <div class="card-body">
                            <h6 style="font-family: 'K2D', sans-serif;">การปรับแผนการรับนิสิตเข้าศึกษา ปีการศึกษา</h6>
                            <input type="text" name="year" class="form-control" id="year" placeholder="">
                          </div>
                          <div style="margin-top: 20px;"></div>
                          <div class="card-body" style="text-align: right; margin-bottom: -1.25rem; margin-top: -2.5rem;">
                            <button type="button" class="btn btn-primary" id="saveYear" style="font-family: 'K2D', sans-serif;">บันทึก</button>
                          </div>

                          <div class="card-body bg-white shadow-md rounded-lg">
                            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
                              <thead class='bg-gray-200 text-gray-600'>
                                <tr>
                                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                                </tr>
                              </thead>
                              <tbody id="datayear">
                                <!-- ข้อมูลจะแสดงที่นี่ -->

                              </tbody>
                            </table>
                          </div>
                          <div class="card-footer">
                          </div>

                        </div>
                      </div>
                    </div>


                    <div class="card-body">
                      <div class="card card-outline card-info">
                        <div class="card-header">
                          <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                            รายละเอียดสาระการปรับปรุงแก้ไข
                          </h3>
                        </div>
                        <div class="card-body">
                          <div class="card" style="margin-top: 20px;">
                          </div>

                          <div class="card mt-4" style="margin-bottom: 20px;">
                            <div class="card-header">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif;">หลักสูตร</h3>
                            </div>
                            <div class="card-body">
                              <textarea id="course" class="form-control" rows="4"></textarea>
                            </div>
                          </div>
                          <div class="card mt-4" style="margin-bottom: 20px;">
                            <div class="card-header">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif;">จำนวนแผนการรับ (เดิม)</h3>
                            </div>
                            <div class="card-body">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif; margin-bottom: 30px;">ระบบปกติ</h3>
                            </div>
                            <div class="card-body">
                              <textarea id="old_normal" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="card-body">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif; margin-bottom: 30px;">ระบบพิเศษ</h3>
                            </div>
                            <div class="card-body">
                              <textarea id="old_special" class="form-control" rows="4"></textarea>
                            </div>
                          </div>
                          <div class="card mt-4" style="margin-bottom: 20px;">
                            <div class="card-header">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif;">จำนวนแผนการรับ (ใหม่)</h3>
                            </div>
                            <div class="card-body">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif; margin-bottom: 30px;">ระบบปกติ</h3>
                            </div>
                            <div class="card-body">
                              <textarea id="new_normal" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="card-body">
                              <h3 class="card-title" style="font-family: 'K2D', sans-serif; margin-bottom: 30px;">ระบบพิเศษ</h3>
                            </div>
                            <div class="card-body">
                              <textarea id="new_special" class="form-control" rows="4"></textarea>
                            </div>
                          </div>
                          <div class="card-body" style="text-align: right; margin-bottom: 20px; ">
                            <button type="button" class="btn btn-primary" id="savetb1" style="font-family: 'K2D', sans-serif; ">
                              บันทึก
                            </button>
                          </div>

                          <div class="card-body" style="text-align: right; margin-bottom: -1.25rem; margin-top: -2.5rem;">
                            <table style="font-family: 'K2D', sans-serif; ">
                              <thead>
                                <tr>
                                  <th rowspan="2">หลักสูตร</th>
                                  <th colspan="2">จำนวนแผนการรับ (เดิม)</th>
                                  <th colspan="2">จำนวนแผนการรับ (ใหม่)</th>
                                  <th colspan="2">การกระทำ</th>
                                </tr>
                                <tr>
                                  <th>ระบบปกติ</th>
                                  <th>ระบบพิเศษ</th>
                                  <th>ระบบปกติ</th>
                                  <th>ระบบพิเศษ</th>
                                  <th>แก้ไข</th>
                                  <th>ลบ</th>
                                </tr>
                              </thead>
                              <tbody id="tb1">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="card-body">
                      <div class="form-group">
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              โครงสร้างหลักสูตร
                            </h3>
                          </div>
                          <div class="card-body">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              โครงสร้างหลักสูตร (จำนวนหน่วยกิตรวม จำนวนหน่วยกิตของรายวิชาหมวดต่าง ๆ) ไม่มีการเปลี่ยนแปลง ภายหลังการปรับปรุงแก้ไข เมื่อเปรียบเทียบกับโครงสร้างเดิม <br>และเกณฑ์มาตรฐานหลักสูตรระดับอุดมศึกษา
                            </h3>
                          </div>
                          <div class="card-footer">
                          </div>
                        </div>
                      </div>
                    </div>



                    <div class="card-body">
                      <div class="form-group">
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title" style="font-family: 'K2D', sans-serif;">
                              ประเด็นที่เสนอ
                            </h3>
                          </div>
                          <div class="card-body">
                            <textarea id="proposed_issue">
                </textarea>
                          </div>
                          <div class="card-body" style="text-align: right; margin-bottom: -1.25rem; margin-top: -2.5rem;">
                            <button type="button" class="btn btn-primary" id="saveIssue" style="font-family: 'K2D', sans-serif;">บันทึก</button>
                          </div>

                          <div class="card-body bg-white shadow-md rounded-lg">
                            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
                              <thead class='bg-gray-200 text-gray-600'>
                                <tr>
                                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                                </tr>
                              </thead>
                              <tbody id="dataissue">
                                <!-- ข้อมูลจะแสดงที่นี่ -->

                              </tbody>
                            </table>
                          </div>
                          <div class="card-footer">

                          </div>

                        </div>
                      </div>

                    </div>

                    <div class="card-body">
                      <div class="card card-outline card-info">
                        <div class="card-body text-center">
                          <button id="cmdpdf" class="btn btn-primary btn-lg" style="margin-top: 20px; font-family: 'K2D', sans-serif; width: 50%;">
                            พิมพ์เอกสาร
                          </button>
                        </div>
                        <div class="card-footer">
                        </div>
                      </div>
                    </div>



            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
          </footer>

          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
          </aside>
          <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <!-- <script src="./dist/js/demo.js"></script> -->
        <!-- Page specific script -->
        <script src="../plugins/summernote/summernote-bs4.min.js"></script>

        <script>
          document.getElementById('cmdpdf').addEventListener('click', function() {
            // เพิ่มโค้ดสำหรับการพิมพ์เอกสารที่นี่
            window.open('../template/4_2.php?pid=' + 666, '_blank');
          });
        </script>

        <script>
          $(function() {
            // Summernote
            $('#title').summernote()
            $('#reason').summernote()
            // $('#year').summernote()
            $('#course').summernote()
            $('#old_normal').summernote()
            $('#old_special').summernote()
            $('#new_normal').summernote()
            $('#new_special').summernote()
            $('#proposed_issue').summernote()
            // CodeMirrorproposed_issue
            // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            //   mode: "htmlmixed",
            //   theme: "monokai"
            // });
          })
        </script>

        <!-- -------------------------------------------------------บันทึกข้อมูล---------------------------------------------------- -->

        <script>
          $(document).ready(function() {
            $('#saveTitle').click(function() {
              var title = $('#title').summernote('code'); // ใช้ .summernote('code') เพื่อดึงเนื้อหา

              // เข้ารหัส title เป็น Base64
              var encodedTitle = btoa(unescape(encodeURIComponent(title)));

              // ล็อกข้อมูล title ที่ถูกเข้ารหัสไปที่คอนโซล
              // console.log('Encoded Title to be sent:', encodedTitle);
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');
              $.ajax({
                type: 'POST',
                url: 'saveDataBack4_2.php', // URL ของ PHP script
                data: {
                  action: 'saveTitle',
                  title: encodedTitle, // ส่งข้อมูลที่ถูกเข้ารหัสเป็น Base64
                  programId: pid // เพิ่ม pamerry key ในคำขอ
                },
                success: function(response) {
                  // console.log('Server Response:', response); // ล็อกการตอบสนองจากเซิร์ฟเวอร์
                  alert(response.response);

                  fetchDataTitle();

                },
                error: function(xhr, status, error) {
                  // console.error('Error:', error); // ล็อกข้อผิดพลาด
                  alert('เกิดข้อผิดพลาดในการบันทึกชื่อเรื่อง.');
                }

              });

            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $('#saveReason').click(function() {
              var reason = $('#reason').summernote('code'); // ใช้ .summernote('code') เพื่อดึงเนื้อหา

              // เข้ารหัส reason เป็น Base64
              var encodedreason = btoa(unescape(encodeURIComponent(reason)));

              // ล็อกข้อมูล reason ที่ถูกเข้ารหัสไปที่คอนโซล
              // console.log('Encoded reason to be sent:', encodedreason);
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');
              $.ajax({
                type: 'POST',
                url: 'saveDataBack4_2.php', // URL ของ PHP script
                data: {
                  action: 'saveReason',
                  reason: encodedreason, // ส่งข้อมูลที่ถูกเข้ารหัสเป็น Base64
                  programId: pid // เพิ่ม pamerry key ในคำขอ
                },
                success: function(response) {
                  // console.log('Server Response:', response); // ล็อกการตอบสนองจากเซิร์ฟเวอร์
                  alert(response.response);
                  fetchDataReason();

                },
                error: function(xhr, status, error) {
                  // console.error('Error:', error); // ล็อกข้อผิดพลาด
                  alert('เกิดข้อผิดพลาดในการบันทึกชื่อเรื่อง.');
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $('#saveYear').click(function() {
              var year = $('#year').val(); // ใช้ .val() เพื่อดึงค่าจาก input หรือ textarea

              // ล็อกข้อมูล year ไปที่คอนโซล
              // console.log('Year to be sent:', year);
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');

              $.ajax({
                type: 'POST',
                url: 'saveDataBack4_2.php', // URL ของ PHP script
                data: {
                  action: 'saveYear',
                  year: year, // ส่งข้อมูลจาก input หรือ textarea
                  programId: pid // เพิ่ม programId key ในคำขอ
                },
                success: function(response) {
                  // console.log('Server Response:', response); // ล็อกการตอบสนองจากเซิร์ฟเวอร์
                  alert(response.response);
                  fetchDataYear();
                },
                error: function(xhr, status, error) {
                  console.error('Error:', error); // ล็อกข้อผิดพลาด
                  alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล.');
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $('#savetb1').click(function() {
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid'); // Get the program ID from URL

              // Gather data from Summernote fields
              var course = $('#course').summernote('code');
              var old_normal = $('#old_normal').summernote('code');
              var old_special = $('#old_special').summernote('code');
              var new_normal = $('#new_normal').summernote('code');
              var new_special = $('#new_special').summernote('code');

              // Base64 encode the input values
              var encodedCourse = btoa(unescape(encodeURIComponent(course)));
              var encodedOldNormal = btoa(unescape(encodeURIComponent(old_normal)));
              var encodedOldSpecial = btoa(unescape(encodeURIComponent(old_special)));
              var encodedNewNormal = btoa(unescape(encodeURIComponent(new_normal)));
              var encodedNewSpecial = btoa(unescape(encodeURIComponent(new_special)));

              var data = [{
                course: encodedCourse,
                old_normal: encodedOldNormal,
                old_special: encodedOldSpecial,
                new_normal: encodedNewNormal,
                new_special: encodedNewSpecial
              }];

              // Send the data to the server via AJAX
              $.ajax({
                type: 'POST',
                url: 'saveDataBack4_2.php',
                data: {
                  action: 'tb1',
                  programId: pid,
                  data: JSON.stringify(data)
                },
                success: function(response) {
                  alert('ข้อมูลถูกบันทึกสำเร็จ!'); // Show success message
                  fetchDataTb1(); // Refresh the data
                },
                error: function(xhr, status, error) {
                  console.error("AJAX Error: ", error); // Log error details
                  alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล.'); // Show error message
                }
              });
            });
          });
        </script>

        <script>
          $(document).ready(function() {
            $('#saveIssue').click(function() {
              var issue = $('#proposed_issue').summernote('code'); // ใช้ .summernote('code') เพื่อดึงเนื้อหา

              // เข้ารหัสข้อมูล issue เป็น Base64
              var encodeissue = btoa(unescape(encodeURIComponent(issue)));

              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');

              $.ajax({
                type: 'POST',
                url: 'saveDataBack4_2.php',
                data: {
                  action: 'saveIssue',
                  issue: encodeissue,
                  programId: pid
                },
                success: function(response) {
                  // console.log('Server Response:', response); // ล็อกการตอบสนองจากเซิร์ฟเวอร์
                  alert(response.response);

                  fetchDataIssue();

                },
                error: function(xhr, status, error) {
                  // console.error('Error:', error); // ล็อกข้อผิดพลาด
                  alert('เกิดข้อผิดพลาดในการบันทึกประเด็นที่เสนอ.');
                }

              });

            });
          });
        </script>

        <!-- -------------------------------------------------------แก้ไขข้อมูล---------------------------------------------------- -->
        <script>
          function editDataTitle(title) {
            // เข้ารหัส title เป็น Base64
            var encodedTitle = btoa(unescape(encodeURIComponent(title)));
            // ดึงค่า pid จาก URL
            var urlParams = new URLSearchParams(window.location.search);
            var pid = urlParams.get('pid');
            // console.log('PID:', pid); // แสดงค่า pid จาก URL

            // ส่งข้อมูลด้วย AJAX
            $.ajax({
              type: 'POST',
              url: 'editDataBack4_2.php',
              data: {
                action: 'editDataTitle',
                title: encodedTitle,
                programId: pid
              },
              success: function(response) {

                if ($('#title').summernote) {

                  $('#title').summernote('code', response.title); // ใส่ข้อมูลใน Summernote editor

                  fetchDataTitle(); // โหลดข้อมูลใหม่หลังจากการแก้ไข
                } else {
                  // console.log('Entered ELSE block: Using regular textarea'); // แสดงข้อความเมื่อเข้าเงื่อนไข else
                  // ถ้าไม่ใช้ Summernote, ใช้ textarea ธรรมดา
                  document.getElementById('title').value = response; // แสดงข้อมูลใน textarea
                }
              },
              error: function(xhr, status, error) {
                // console.error('Error:', error); // แสดงข้อผิดพลาดเมื่อมีปัญหาในการส่งข้อมูลหรือรับข้อมูล
                // console.log('XHR Object:', xhr); // แสดงรายละเอียดเพิ่มเติมของ XMLHttpRequest object
                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล.');
              }
            });
          }
        </script>

        <script>
          function editDataReason(reason) {
            // เข้ารหัส title เป็น Base64
            var encodedReason = btoa(unescape(encodeURIComponent(reason)));
            console.log('Encoded Title to be sent:', encodedReason);

            // ดึงค่า pid จาก URL
            var urlParams = new URLSearchParams(window.location.search);
            var pid = urlParams.get('pid');

            // ส่งข้อมูลด้วย AJAX
            $.ajax({
              type: 'POST',
              url: 'editDataBack4_2.php',
              data: {
                action: 'editDataReason',
                reason: encodedReason,
                programId: pid
              },
              success: function(response) {
                // ตรวจสอบว่าคุณใช้ Summernote หรือไม่
                if ($('#reason').summernote) {
                  $('#reason').summernote('code', response.reason);

                  fetchDataReason();

                } else {
                  // ถ้าไม่ใช้ Summernote, ใช้ textarea ธรรมดา
                  document.getElementById('reason').value = response;
                }
              },
              error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล.');
              }
            });

          }
        </script>
        <script>
          function editDataYear(year) {
            // Encode year using Base64
            var year = $('#year').val();
            // console.log('Encoded Year to be sent:', encodedYear);

            // Get programId from URL parameters
            var urlParams = new URLSearchParams(window.location.search);
            var pid = urlParams.get('pid');

            // Send data via AJAX
            $.ajax({
              type: 'POST',
              url: 'editDataBack4_2.php',
              data: {
                action: 'editDataYear',
                year: year,
                programId: pid
              },
              success: function(response) {
                // If a plain textarea is used
                var yearElement = document.getElementById('year');
                if (yearElement) {
                  yearElement.value = response.year;
                } else {
                  // console.error('Element with id "year" not found.');
                }

                // Fetch updated data
                fetchDataYear();
              },
              error: function(xhr, status, error) {
                // console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล');
              }
            });
          }
        </script>


        <script>
          function editDataTb1(course) {
            var urlParams = new URLSearchParams(window.location.search);
            var pid = urlParams.get('pid'); // Get programId from URL
            var encodecourse = btoa(unescape(encodeURIComponent(course)));
            // console.log(course);


            // console.log(pid, encodecourse);

            // Check if pid and course are valid
            if (!pid || !encodecourse) {
              alert('ข้อมูลไม่ถูกต้อง');
              console.error('Program ID หรือ Course ไม่ถูกต้อง');
              return;
            }

            // Send AJAX request to fetch data for editing
            $.ajax({
              type: 'POST',
              url: 'editDataBack4_2.php',
              data: {
                action: 'edittb1',
                course: encodecourse, // Send the raw course content (HTML)
                programId: pid // Send programId
              },
              success: function(response) {
                if (response.error) {
                  alert('เกิดข้อผิดพลาด: ' + response.error);
                  return;
                }

                // Populate fields
                if (response && response.course) {
                  $('#course').summernote('code', response.course); // For editor
                  $('#old_normal').summernote('code', response.old_normal);
                  $('#old_special').summernote('code', response.old_special);
                  $('#new_normal').summernote('code', response.new_normal);
                  $('#new_special').summernote('code', response.new_special);
                } else {
                  alert('ไม่พบข้อมูลสำหรับการแก้ไข.');
                }
              },
              error: function(xhr, status, error) {
                console.error('Error in AJAX request:', error);
                alert('เกิดข้อผิดพลาดในการดึงข้อมูล.');
              }
            });
          }
        </script>

        <script>
          function editDataIssue(issue) {
            // เข้ารหัส title เป็น Base64
            var encodeIssue = btoa(unescape(encodeURIComponent(issue)));
            // console.log('Encoded Title to be sent:', encodedTitle); // แสดงค่า title ที่ถูกเข้ารหัส

            // ดึงค่า pid จาก URL
            var urlParams = new URLSearchParams(window.location.search);
            var pid = urlParams.get('pid');
            // console.log('PID:', pid); // แสดงค่า pid จาก URL

            // ส่งข้อมูลด้วย AJAX
            $.ajax({
              type: 'POST',
              url: 'editDataBack4_2.php',
              data: {
                action: 'editDataIssue',
                issue: encodeIssue, // ส่งข้อมูลที่ถูกเข้ารหัสเป็น Base64
                programId: pid
              },
              success: function(response) {
                // console.log('Response from server:', response.title); // แสดงข้อมูลที่ได้รับกลับมาจากเซิร์ฟเวอร์

                // ตรวจสอบว่าคุณใช้ Summernote หรือไม่
                if ($('#proposed_issue').summernote) {
                  // console.log('Entered IF block: Using Summernote'); // แสดงข้อความเมื่อเข้าเงื่อนไข if
                  $('#proposed_issue').summernote('code', response.proposed_issue); // ใส่ข้อมูลใน Summernote editor

                  fetchDataIssue(); // โหลดข้อมูลใหม่หลังจากการแก้ไข
                } else {

                  document.getElementById('proposed_issue').value = response; // แสดงข้อมูลใน textarea
                }
              },
              error: function(xhr, status, error) {

                alert('เกิดข้อผิดพลาดในการโหลดข้อมูล.');
              }
            });
          }
        </script>

        <!-- -------------------------------------------------------ลบข้อมูล---------------------------------------------------- -->

        <script>
          function clearTitleById(id) {
            if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')) {
              // console.log(id);
              var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
              var pid = urlParams.get('pid');



              $.ajax({
                type: 'POST',
                url: 'deleteDataBack4_2.php',
                data: {
                  action: 'clearTitleById',
                  id: id, // ส่ง id ไปเพื่อทำการเคลียร์ title
                  programId: pid

                },
                success: function(response) {
                  // console.log( response);
                  alert(response.title);
                  fetchDataTitle();
                  // location.reload()
                  // รีเฟรชหน้าเพื่อแสดงการเปลี่ยนแปลง
                },
                error: function(xhr, status, error) {
                  console.error('Error:', error);
                  alert('เกิดข้อผิดพลาดในการเคลียร์ข้อมูล.');
                }
              });
            }
          }
        </script>

        <script>
          function clearReasonById(id) {
            if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')) {
              // console.log(id);
              var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
              var pid = urlParams.get('pid');

              $.ajax({
                type: 'POST',
                url: 'deleteDataBack4_2.php',
                data: {
                  action: 'clearReasonById',
                  id: id, // ส่ง id ไปเพื่อทำการเคลียร์ title
                  programId: pid

                },
                success: function(response) {
                  // console.log( response);
                  alert(response.reason);
                  fetchDataReason();
                  // location.reload()
                  // รีเฟรชหน้าเพื่อแสดงการเปลี่ยนแปลง
                },
                error: function(xhr, status, error) {
                  // console.error('Error:', error);
                  alert('เกิดข้อผิดพลาดในการเคลียร์ข้อมูล.');
                }
              });
            }
          }
        </script>

        <script>
          function clearYearById(id) {
            if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')) {
              console.log('ID to clear:', id);

              // Get programId from URL parameters
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');

              $.ajax({
                type: 'POST',
                url: 'deleteDataBack4_2.php',
                data: {
                  action: 'clearYearById',
                  id: id,
                  programId: pid
                },
                success: function(response) {
                  alert(response.year);
                  fetchDataYear(); // Fetch the updated reason data
                },
                error: function(xhr, status, error) {
                  // console.error('Error:', error);
                  alert('เกิดข้อผิดพลาดในการเคลียร์ข้อมูล.');
                }
              });
            }
          }
        </script>

        <script>
          function clearTb1ById(course) {
            if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')) {
              var urlParams = new URLSearchParams(window.location.search);
              var pid = urlParams.get('pid');

              var encodedCourse = btoa(unescape(encodeURIComponent(course)));
              // console.log(encodedCourse);

              $.ajax({
                type: 'POST',
                url: 'deleteDataBack4_2.php',
                data: {
                  action: 'clearDataTb1ById',
                  course: encodedCourse, // ใช้ชื่อ index_number ที่เข้ารหัสแล้ว
                  programId: pid
                },
                success: function(response) {
                  // console.log(response.indexNumber);
                  alert(response.course);

                  fetchDataTb1(); // รีเฟรชข้อมูลหลังลบสำเร็จ
                },
                error: function(xhr, status, error) {
                  console.error('Error:', error);
                  alert('เกิดข้อผิดพลาดในการเคลียร์ข้อมูล.');
                }
              });
            }
          }
        </script>

        <script>
          function clearIssueById(id) {
            if (confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้?')) {
              // console.log(id);
              var urlParams = new URLSearchParams(window.location.search); // แสดงค่า id ที่ได้รับมา
              var pid = urlParams.get('pid');

              $.ajax({
                type: 'POST',
                url: 'deleteDataBack4_2.php',
                data: {
                  action: 'clearIssueById',
                  id: id, // ส่ง id ไปเพื่อทำการเคลียร์ title
                  programId: pid

                },
                success: function(response) {
                  // console.log( response);
                  alert(response.proposed_issue);
                  fetchDataIssue();
                  // location.reload()
                  // รีเฟรชหน้าเพื่อแสดงการเปลี่ยนแปลง
                },
                error: function(xhr, status, error) {
                  console.error('Error:', error);
                  alert('เกิดข้อผิดพลาดในการเคลียร์ข้อมูล.');
                }
              });
            }
          }
        </script>
      </body>

</html>