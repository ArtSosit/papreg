<?php
include 'dbconn.php';
$sql = "SELECT * FROM test2";
$result = $conn->query($sql);
$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[$row['fid']] = $row['text']; // เก็บข้อมูลโดยใช้ 'fid' เป็นคีย์
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Summernote with Bootstrap 4</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

  <script>
    $(document).ready(function() {
      fetchData();
    });

    let fetchedDataArray = []; // ตัวแปรสำหรับเก็บข้อมูลในรูปแบบ array

    function fetchData() {
      $.ajax({
        url: 'fetch_data.php', // URL ของ PHP ที่จะดึงข้อมูล
        type: 'GET', // การส่งข้อมูลแบบ GET
        dataType: 'json', // กำหนดให้รับข้อมูลในรูปแบบ JSON
        data: {
          action: 'getAll' // ส่งค่า action ไปด้วย
        },
        success: function(data) {
          if (data.response === 'success') {
            const fetchedDataArray = data.data; // ข้อมูลที่ดึงมา
            console.log("ข้อมูลทั้งหมดที่ดึงมา:", fetchedDataArray);

            const tbody = $('#datatitle'); // อ้างอิง <tbody>
            tbody.empty(); // ล้างข้อมูลเก่าใน <tbody>

            // วนลูปเพื่อเพิ่มข้อมูลลงในตาราง
            fetchedDataArray.forEach((item, index) => {
              const row = `
                        <tr>
                            <td>${item}</td>
                            <td>
                                <button class="btn btn-warning edit-btn" data-form-id="${index + 1}">แก้ไข</button>
                                <button class="btn btn-danger delete-btn" data-form-id="${index + 1}">ลบ</button>
                            </td>
                        </tr>
                    `;
              tbody.append(row); // เพิ่มแถวใหม่ใน <tbody>
            });
          } else {
            console.error('ไม่พบข้อมูลในฐานข้อมูล');
            alert('ไม่พบข้อมูลในฐานข้อมูล');
          }
        },
        error: function(xhr, status, error) {
          console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
      });
    }
  </script>

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
<!-- <button onclick="fetchData()"></button> -->

<body style=" font-family: 'K2D' , sans-serif ,hold-transition sidebar-mini">
  <!-- nav -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- nav offcanva -->

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav
    ">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- end nav -->
  <div class="container mt-5">
    <h1>ฟอร์มบันทึกข้อมูล</h1>
    <div class="card mt-5">
      <label class="card-header card-outline" for="origin_info">4.6</label>
      <div class="card-body bg-white shadow-md rounded-lg">
        <h5><b>4.6 การปรับปรุงรายละเอียดการเทียบโอนหน่วยกิต รายวิชาและการลงทะเบียนเรียน ข้ามมหาวิทยาลัย และการปรับปรุงรายละเอียดกฎระเบียบหรือหลักเกณฑ์ในการให้ระดับคะแนน
            (เกรด) ในหมวดวิชาศึกษาทั่วไป (ฉบับปรับปรุง พ.ศ. 2566) สำนักศึกษาทั่วไป</b></h5>
      </div>
      <div class="card-footer">
      </div>
    </div>
    <!-- หลักการและเหตุผล -->
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header" for="reasons">หลักการและเหตุผล</label>
        <div class="card-body">
          <textarea id="reasons" class="form-control"></textarea>
          <button id="savereasons" data-form-id="1" class="btn btn-success mt-2">บันทึก</button>
        </div>
        <div class="card-body bg-white shadow-md rounded-lg">
          <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
            <thead class='bg-gray-200 text-gray-600'>
              <tr>
                <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
              </tr>
            </thead>
            <tbody id="fetchData">
              <!-- <td></td> -->
              <!-- <td><button class="btn btn-warning edit-btn" id="editreasons" data-form-id="1">แก้ไข</button><button class="btn btn-danger" data-form-id="1">ลบ</button></td> -->
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>

    <!-- สาระการปรับปรุงแก้ไข -->
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header" for="Improving_content">สาระการปรับปรุงแก้ไข</label>
        <div class="card-body">
          <textarea id="Improving_content" class="form-control"></textarea>
          <button id="saveImproving_content" data-form-id="2" class="btn btn-success mt-2">บันทึก</button>
          <div class="card-body bg-white shadow-md rounded-lg">
            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
              <thead class='bg-gray-200 text-gray-600'>
                <tr>
                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                </tr>
              </thead>
              <tbody id="fetchData">
                <td>

                </td>
                <td><button class="btn btn-warning edit-btn" id="editImproving_content" data-form-id="2">แก้ไข</button><button class="btn btn-danger" data-form-id="2">ลบ</button></td>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header">จัดการข้อมูล</label>
        <div class="card-body">
          <!-- Textarea ทั้ง 3 ส่วน -->
          <div class="section">
            <label for="origin_info">ข้อมูลเดิม</label>
            <textarea id="origin_info" class="form-control mt-2"></textarea>
          </div>

          <div class="section mt-4">
            <label for="updated_info">ข้อมูลปรับปรุงใหม่</label>
            <textarea id="updated_info" class="form-control mt-2"></textarea>
          </div>

          <div class="section mt-4">
            <label for="improv_info">สาระการปรับปรุง</label>
            <textarea id="improv_info" class="form-control mt-2"></textarea>
          </div>

          <!-- ปุ่มบันทึก -->
          <button id="Allsave" class="btn btn-success mt-4">บันทึกทั้งหมด</button>
        </div>

        <!-- แสดงข้อมูลในตาราง -->
        <div class="card-body bg-white shadow-md rounded-lg mt-4">
          <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
            <thead class='bg-gray-200 text-gray-600'>
              <tr>
                <th class='py-2 px-4 border-b font-k2d'>ข้อมูลเดิม</th>
                <th class='py-2 px-4 border-b font-k2d'>ข้อมูลปรับปรุงใหม่</th>
                <th class='py-2 px-4 border-b font-k2d'>สาระการปรับปรุง</th>
                <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $data[3] ?? ""; ?></td>
                <td><?php echo $data[4] ?? ""; ?></td>
                <td><?php echo $data[5] ?? ""; ?></td>
                <td>
                  <button class="btn btn-warning" id="editAll">แก้ไข</button>
                  <button class="btn btn-danger" data-form-id="[3, 4, 5]">ลบ</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header">จัดการข้อมูล2</label>
        <div class="card-body">

          <!-- ข้อมูลเดิม2 -->
          <div class="section">
            <label for="origin_info2">ข้อมูลเดิม2</label>
            <textarea id="origin_info2" class="form-control mt-2"></textarea>
          </div>

          <!-- ข้อมูลปรับปรุงใหม่2 -->
          <div class="section mt-4">
            <label for="updated_info2">ข้อมูลปรับปรุงใหม่2</label>
            <textarea id="updated_info2" class="form-control mt-2"></textarea>
          </div>

          <!-- สาระการปรับปรุง2 -->
          <div class="section mt-4">
            <label for="improv_info2">สาระการปรับปรุง2</label>
            <textarea id="improv_info2" class="form-control mt-2"></textarea>
          </div>
          <button id="Allsave2" class="btn btn-success mt-4">บันทึกทั้งหมด</button>
        </div>

        <!-- แสดงข้อมูลทั้งหมดในตาราง -->
        <div class="card-body bg-white shadow-md rounded-lg mt-4">
          <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
            <thead class='bg-gray-200 text-gray-600'>
              <tr>
                <th class='py-2 px-4 border-b font-k2d'>ข้อมูลเดิม2</th>
                <th class='py-2 px-4 border-b font-k2d'>ข้อมูลปรับปรุงใหม่2</th>
                <th class='py-2 px-4 border-b font-k2d'>สาระการปรับปรุง2</th>
                <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $data[6] ?? ""; ?></td>
                <td><?php echo $data[7] ?? ""; ?></td>
                <td><?php echo $data[8] ?? ""; ?></td>
                <td>
                  <button class="btn btn-warning" id="editAll2">แก้ไข</button>
                  <button class="btn btn-danger" data-form-id="[6,7,8]">ลบ</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class=" card-footer">
        </div>
      </div>
    </div>

    <!-- ประเด็นที่เสนอ -->
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header" for="propos_issue">ประเด็นที่เสนอ</label>
        <div class="card-body">
          <textarea id="propos_issue" class="form-control"></textarea>
          <button id="savepropos_issue" data-form-id="9" class="btn btn-success mt-2">บันทึก</button>
          <div class="card-body bg-white shadow-md rounded-lg">
            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
              <thead class='bg-gray-200 text-gray-600'>
                <tr>
                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                </tr>
              </thead>
              <tbody id="datatitle">
                <td> <?php echo $data[9] ?? "ไม่มีข้อมูล"; ?></td>
                <td><button class="btn btn-warning edit-btn" id="editpropos_issue" data-form-id="9">แก้ไข</button><button class="btn btn-danger" data-form-id="9">ลบ</button></td>
              </tbody>
            </table>
          </div>

        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>

    <!-- มติ -->
    <div class="form-group">
      <div class="card mt-5">
        <label class="card-header" for="mati">มติ</label>
        <div class="card-body">
          <textarea id="mati" class="form-control"></textarea>
          <button id="savemati" data-form-id="10" class="btn btn-success mt-2">บันทึก</button>
          <div class="card-body bg-white shadow-md rounded-lg">
            <table class='w-full table-auto bg-gray-100 rounded-lg overflow-hidden'>
              <thead class='bg-gray-200 text-gray-600'>
                <tr>
                  <th class='py-2 px-4 border-b font-k2d'>หัวข้อ</th>
                  <th class='py-2 px-4 border-b font-k2d'>การกระทำ</th>
                </tr>
              </thead>
              <tbody id="datatitle">
                <td> <?php echo $data[10] ?? "ไม่มีข้อมูล"; ?></td>
                <td><button class="btn btn-warning edit-btn" id="editmati" data-form-id="10">แก้ไข</button><button class="btn btn-danger" data-form-id="10">ลบ</button></td>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
    <script>
      $(function() {
        // Initialize all Summernote editors
        $('#reasons, #Improving_content, #origin_info, #updated_info, #improv_info, #origin_info2, #updated_info2, #improv_info2, #propos_issue, #mati').summernote({

          height: 120,
        });

        // เพิ่ม
        $('#Allsave').on('click', function() {
          const originInfo = $('#origin_info').val();
          const updatedInfo = $('#updated_info').val();
          const improvInfo = $('#improv_info').val();
          console.log(originInfo, updatedInfo, improvInfo);

          // ส่งข้อมูลทั้งหมดไปที่เซิร์ฟเวอร์ผ่าน AJAX
          $.ajax({
            url: 'insert.php', // ไฟล์ PHP สำหรับบันทึกข้อมูล
            type: 'POST',
            data: {
              action: 'Allsave',
              origin_info: originInfo,
              updated_info: updatedInfo,
              improv_info: improvInfo
            },
            success: function(response) {
              const result = JSON.parse(response);
              if (result.response === 'success') {
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                // console.log(result.response);
                // อัปเดตข้อมูลในตาราง
                $('#data-origin').text(originInfo);
                $('#data-updated').text(updatedInfo);
                $('#data-improv').text(improvInfo);
                location.reload();
              } else {
                alert('เกิดข้อผิดพลาดในการบันทึก');
                location.reload();
              }
            },
            error: function() {
              alert('เกิดข้อผิดพลาดในการส่งข้อมูล');
              // location.reload();
            }
          });
        });

        // Handler for saving second set of fields
        $('#Allsave2').on('click', function() {
          const originInfo = $('#origin_info2').val();
          const updatedInfo = $('#updated_info2').val();
          const improvInfo = $('#improv_info2').val();
          console.log(originInfo, updatedInfo, improvInfo);

          // ส่งข้อมูลทั้งหมดไปที่เซิร์ฟเวอร์ผ่าน AJAX
          $.ajax({
            url: 'insert.php', // ไฟล์ PHP สำหรับบันทึกข้อมูล
            type: 'POST',
            data: {
              action: 'Allsave2',
              origin_info: originInfo,
              updated_info: updatedInfo,
              improv_info: improvInfo
            },
            success: function(response) {
              const result = JSON.parse(response);
              if (result.response === 'success') {
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                windlow.location.reload();
                // อัปเดตข้อมูลในตาราง
                $('#data-origin2').text(originInfo);
                $('#data-updated2').text(updatedInfo);
                $('#data-improv2').text(improvInfo);
                location.reload();
              } else {

                alert('เกิดข้อผิดพลาดในการบันทึก');
                location.reload();

              }
            },
            error: function() {
              alert('เกิดข้อผิดพลาดในการส่งข้อมูล');
              // location.reload();
            }
          });
        });

      });

      function saveData(selector, formId) {
        var data = $(selector).summernote('code'); // Get the content
        console.log(data);

        // Check if content is empty or not
        if (data.trim() === "" || data.trim() === "<p><br></p>") {
          alert('เนื้อหาว่างเปล่า กรุณาเพิ่มข้อมูลก่อนบันทึก.');
          return; // Exit the function if content is empty
        }

        var encodedData = btoa(unescape(encodeURIComponent(data))); // Encode in Base64
        console.log(encodedData);

        // AJAX request to save the data
        $.ajax({
          type: 'POST',
          url: 'insert.php',
          data: {
            action: 'saveform',
            data: encodedData,
            formId: formId // Send form ID to identify which form is being saved
          },
          success: function(response) {
            alert("บันทึกข้อมูลแล้ว"); // Handle success response
            // loadLatestData(); // Optionally refresh the content after saving
          },
          error: function(xhr, status, error) {
            alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล.');
          }
        });
      }

      // Attach click event handlers dynamically to buttons
      $('[id^="save"]').click(function() {
        var formId = $(this).data('form-id'); // Get form ID from the button's data attribute
        var relatedInputId = $(this).attr('id').replace('save', ''); // Extract the related input ID
        var selector = '#' + relatedInputId; // Create the selector dynamically

        saveData(selector, formId); // Call the save function with dynamic selector and form ID
      });

      // แก้ไข
      $('#editAll').on('click', function() {
        $.ajax({
          url: 'edit.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ของคุณ
          type: 'POST',
          data: {
            action: 'getAll'
          },
          success: function(response) {
            // ตรวจสอบ response ว่า success หรือไม่
            if (response && response.response === 'success') {
              // กำหนดค่าที่ดึงมาใส่ใน Summernote
              $('#origin_info').summernote('code', response.data[3] || '');
              $('#updated_info').summernote('code', response.data[4] || '');
              $('#improv_info').summernote('code', response.data[5] || '');
            } else {
              console.error('No data found or invalid response:', response);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          },
        });
      });


      $('#editAll2').on('click', function() {
        console.log('editAll2');
        $.ajax({
          url: 'edit.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ของคุณ
          type: 'POST',
          data: {
            action: 'getAll2'
          },
          success: function(response) {
            // ตรวจสอบ response ว่า success หรือไม่
            if (response && response.response === 'success') {
              // กำหนดค่าที่ดึงมาใส่ใน Summernote
              $('#origin_info2').summernote('code', response.data[6] || '');
              $('#updated_info2').summernote('code', response.data[7] || '');
              $('#improv_info2').summernote('code', response.data[8] || '');
            } else {
              console.error('No data found or invalid response:', response);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          },
        });
      });

      // Edit button dynamic click handler
      $('.edit-btn').on('click', function() {
        const Id = $(this).attr('id').replace('edit', '');
        console.log(Id);
        const formId = $(this).data('form-id'); // Get form ID from the button
        console.log(formId);

        // Fetch data for the given form ID
        $.ajax({
          url: 'fetch_data.php', // Endpoint for fetching data
          type: 'GET',
          data: {
            formId: formId
          },
          success: function(response) {
            const result = JSON.parse(response);
            if (result.response === 'success') {
              // Load the fetched data into the Summernote editor
              $('#' + Id).summernote('code', result.data);
            } else {
              alert('ไม่พบข้อมูลหรือเกิดข้อผิดพลาด');
            }
          },
          error: function() {
            alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
          }
        });
      });

      // ลบ
      // Attach click event handlers dynamically to delete buttons
      $('.btn-danger').click(function() {
        var formId = $(this).siblings('.edit-btn').data('form-id'); // Get form ID from the sibling edit button's data attribute
        console.log('Delete button clicked', formId);
        // Confirm before deleting

        if (!formId) {
          var formIds = JSON.parse($(this).attr('data-form-id'));
          console.log('Deleting records with fids:', formIds);
          if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลทั้งหมดนี้?')) {
            // ส่งคำขอ AJAX เพื่อทำการลบ
            $.ajax({
              type: 'POST',
              url: 'delete.php',
              data: {
                action: 'delete3form',
                formIds: formIds // ส่ง array ของ fid ไปพร้อมกัน
              },
              success: function(response) {
                alert("ลบข้อมูลทั้งหมดแล้ว");
                location.reload(); // รีเฟรชหน้าเพื่อแสดงผลการลบ
              },
              error: function(xhr, status, error) {
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
              }
            });
          }

        } else {
          if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')) {
            // AJAX request to delete the data
            $.ajax({
              type: 'POST',
              url: 'delete.php',
              data: {
                action: 'deleteform',
                formId: formId // Send form ID to identify which form is being deleted
              },
              success: function(response) {

                alert("ลบข้อมูลแล้ว"); // Handle success response
                location.reload(); // Optionally refresh the page after deleting
              },
              error: function(xhr, status, error) {
                alert('เกิดข้อผิดพลาดในการลบข้อมูล.');
              }
            });
          }
        }
      });
    </script>

</body>

</html>