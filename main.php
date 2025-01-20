
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>ปรับ REG </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400;500;600;700&display=swap">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
  <link rel="stylesheet" href="styles.css">
  <script>
    window.onload = function() {
      fetchDataReasons();
      fetchDataImproving_content();
      fetchDatapropos_issue();
      fetchDatamati();
      fetchDataTb1();
      fetchDataTb2();

    }

    function fetchDataReasons(formId) {
      $.ajax({
        url: 'fetch_data.php', // URL ของ PHP ที่จะดึงข้อมูล
        type: 'GET', // การส่งข้อมูลแบบ GET
        dataType: 'json', // กำหนดให้รับข้อมูลในรูปแบบ JSON
        data: {
          action: 'getAll', // ส่งค่า action ไปด้วย
          formId: formId ?? 1 // ส่ง formId ไปด้วย
        },
        success: function(data) {
          if (data.response === 'success') {
            const fetchedDataArray = data.data; // ข้อมูลที่ดึงมา
            console.log("ข้อมูลทั้งหมดที่ดึงมา:", fetchedDataArray);
            const tbody = $('#fetchDataReasons'); // อ้างอิง <tbody>
            tbody.empty();
            if (Array.isArray(fetchedDataArray) && fetchedDataArray.length > 0) {
              fetchedDataArray.forEach((item) => {
                console.log("ข้อมูล:", item);
                const row = `
              <tr> <!-- เก็บ id เป็น data attribute -->
                <td>${item.text}</td> <!-- สมมุติ item มี title -->
                <td>
                    <button id="editreasons" class="btn btn-warning edit-btn" data-form-id="${item.fid}">แก้ไข</button>
                  <button class="btn btn-danger delete-btn" data-form-id="${item.fid}">ลบ</button>
                </td>
              </tr>`;
                tbody.append(row); // เพิ่มแถวใหม่ใน <tbody>
              });
            } else {
              tbody.append('<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>');
            }
          } else {
            console.error('ไม่พบข้อมูลในฐานข้อมูล:', data);
          }
        },
        error: function(xhr, status, error) {
          console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
      });
    }

    function fetchDataImproving_content(formId) {
      $.ajax({
        url: 'fetch_data.php',
        type: 'GET',
        dataType: 'json',
        data: {
          action: 'getAll',
          formId: formId ?? 2
        },
        success: function(data) {
          if (data.response === 'success') {
            const fetchedDataArray = data.data; // ข้อมูลที่ดึงมา
            console.log("ข้อมูลทั้งหมดที่ดึงมา:", fetchedDataArray);

            const tbody = $('#fetchDataImproving_content'); // อ้างอิง <tbody>
            tbody.empty(); // ล้างข้อมูลเก่าใน <tbody>

            // ตรวจสอบว่า fetchedDataArray เป็น Array และมีข้อมูล
            if (Array.isArray(fetchedDataArray) && fetchedDataArray.length > 0) {
              fetchedDataArray.forEach((item) => {
                console.log("ข้อมูล:", item);
                const row = `
              <tr> <!-- เก็บ id เป็น data attribute -->
                <td><label>${item.text}<label></td> <!-- สมมุติ item มี title -->
                <td>
                  <button id="editImproving_content"class="btn btn-warning edit-btn" data-form-id="${item.fid}">แก้ไข</button>
                  <button class="btn btn-danger delete-btn" data-form-id="${item.fid}">ลบ</button>
                </td>
              </tr>`;
                tbody.append(row); // เพิ่มแถวใหม่ใน <tbody>
              });
            } else {
              tbody.append('<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>');
            }
          } else {
            console.error('ไม่พบข้อมูลในฐานข้อมูล:', data);
          }
        },
        error: function(xhr, status, error) {
          console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
      });
    }

    function fetchDatapropos_issue(formId) {
      $.ajax({
        url: 'fetch_data.php',
        type: 'GET',
        dataType: 'json',
        data: {
          action: 'getAll',
          formId: formId ?? 9
        },
        success: function(data) {
          if (data.response === 'success') {
            const fetchedDataArray = data.data; // ข้อมูลที่ดึงมา
            console.log("ข้อมูลทั้งหมดที่ดึงมา:", fetchedDataArray);

            const tbody = $('#fetchDatapropos_issue'); // อ้างอิง <tbody>
            tbody.empty(); // ล้างข้อมูลเก่าใน <tbody>

            // ตรวจสอบว่า fetchedDataArray เป็น Array และมีข้อมูล
            if (Array.isArray(fetchedDataArray) && fetchedDataArray.length > 0) {
              fetchedDataArray.forEach((item) => {
                console.log("ข้อมูล:", item);
                const row = `
              <tr> <!-- เก็บ id เป็น data attribute -->
                <td>${item.text}</td> <!-- สมมุติ item มี title -->
                <td>
                  <button id="editpropos_issue" class="btn btn-warning edit-btn" data-form-id="${item.fid}">แก้ไข</button>
                  <button class="btn btn-danger delete-btn" data-form-id="${item.fid}">ลบ</button>
                </td>
              </tr>`;
                tbody.append(row); // เพิ่มแถวใหม่ใน <tbody>
              });
            } else {
              tbody.append('<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>');
            }
          } else {
            console.error('ไม่พบข้อมูลในฐานข้อมูล:', data);

          }
        },
        error: function(xhr, status, error) {
          console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
      });
    }

    function fetchDatamati(formId) {
      $.ajax({
        url: 'fetch_data.php',
        type: 'GET',
        dataType: 'json',
        data: {
          action: 'getAll',
          formId: formId ?? 10
        },
        success: function(data) {
          if (data.response === 'success') {
            const fetchedDataArray = data.data; // ข้อมูลที่ดึงมา
            console.log("ข้อมูลทั้งหมดที่ดึงมา:", fetchedDataArray);

            const tbody = $('#fetchDatamati'); // อ้างอิง <tbody>
            tbody.empty(); // ล้างข้อมูลเก่าใน <tbody>

            // ตรวจสอบว่า fetchedDataArray เป็น Array และมีข้อมูล
            if (Array.isArray(fetchedDataArray) && fetchedDataArray.length > 0) {
              fetchedDataArray.forEach((item) => {
                console.log("ข้อมูล:", item);
                const row = `
              <tr> <!-- เก็บ id เป็น data attribute -->
                <td>${item.text}</td> <!-- สมมุติ item มี title -->
                <td>
                  <button id="editmati"class="btn btn-warning edit-btn" data-form-id="${item.fid}">แก้ไข</button>
                  <button class="btn btn-danger delete-btn" data-form-id="${item.fid}">ลบ</button>
                </td>
              </tr>`;
                tbody.append(row); // เพิ่มแถวใหม่ใน <tbody>
              });
            } else {
              tbody.append('<tr><td colspan="2" class="text-center">ไม่มีข้อมูล</td></tr>');
            }
          } else {
            console.error('ไม่พบข้อมูลในฐานข้อมูล:', data);

          }
        },
        error: function(xhr, status, error) {
          console.error('เกิดข้อผิดพลาดในการดึงข้อมูล:', error);
        }
      });
    }
  </script>
  <script>
    function fetchDataTb1() {
      const action = "table1"

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetchtable.php?action=' + action, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var tb1 = JSON.parse(xhr.responseText);
          displayDataTb1(tb1);

        }
      };

      xhr.send();
    }

    function displayDataTb1(tb1) {
      const tableBody = document.getElementById('displayDataTb1');
      if (!tableBody) {
        console.error("Element with ID 'displayDataTb1' not found in the DOM");
        return;
      }

      let output = '';

      // Ensure `tb1.data` is an array and has data
      if (tb1.response === 'success' && Array.isArray(tb1.data) && tb1.data.length > 0) {
        // Build the table rows
        output += `
      <tr class="border-b hover:bg-gray-50">
        <td class="py-2 px-4">${tb1.data.find(item => item.fid === 3)?.text || ''}</td>
        <td class="py-2 px-4">${tb1.data.find(item => item.fid === 4)?.text || ''}</td>
        <td class="py-2 px-4">${tb1.data.find(item => item.fid === 5)?.text || ''}</td>
        <td class="py-2 px-4">
          <button  class="btn btn-warning" onclick="editAll1()">แก้ไข</button>
        </td>
        <td class="py-2 px-4">
          <button class="action-btn delete-btn btn btn-danger" data-form-id="[3,4,5]" >ลบ</button>
        </td>
      </tr>
    `;
      } else {
        // Show "no data" message
        output = `
      <tr>
        <td colspan="5" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td>
      </tr>
    `;
      }

      // Update table body
      tableBody.innerHTML = output;
    }

    function sanitizeHTML(str) {
      const temp = document.createElement('div');
      temp.textContent = str;
      return temp.innerHTML;
    }
  </script>
  <script>
    function fetchDataTb2() {
      const action = "table2"

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'fetchtable.php?action=' + action, true); // ใช้ URL ว่างเพื่อเรียกไฟล์เดียวกัน
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var tb2 = JSON.parse(xhr.responseText);
          displayDataTb2(tb2);
          console.log(tb2);

        }
      };

      xhr.send();
    }

    function displayDataTb2(tb2) {

      const tableBody = document.getElementById('displayDataTb2');
      if (!tableBody) {
        console.error("Element with ID 'displayDataTb2' not found in the DOM");
        return;
      }

      let output = '';

      // Ensure `tb1.data` is an array and has data
      if (tb2.response === 'success' && Array.isArray(tb2.data) && tb2.data.length > 0) {
        // Build the table rows
        output += ` 
      <tr class="border-b hover:bg-gray-50">
        <td class="py-2 px-4">${tb2.data.find(item => item.fid === 6)?.text || ''}</td>
        <td class="py-2 px-4">${tb2.data.find(item => item.fid === 7)?.text || ''}</td>
        <td class="py-2 px-4">${tb2.data.find(item => item.fid === 8)?.text || ''}</td>
        <td class="py-2 px-4">
          <button  class="btn btn-warning" onclick="editAll2()">แก้ไข</button>
        </td>
        <td class="py-2 px-4">
          <button class="action-btn delete-btn btn btn-danger" data-form-id="[6,7,8]" >ลบ</button>
        </td>
      </tr>
    `;
      } else {
        // Show "no data" messagesss
        output = `
      <tr>
        <td colspan="5" class="text-center py-4 text-gray-500">ไม่พบข้อมูล</td>
      </tr>
    `;
      }

      // Update table body
      tableBody.innerHTML = output;
    }

    function sanitizeHTML(str) {
      const temp = document.createElement('div');
      temp.textContent = str;
      return temp.innerHTML;
    }
  </script>
</head>

<body style=" font-family: 'K2D' , sans-serif ,hold-transition sidebar-mini">
  <!-- nav -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ปรับREG</a>
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
            <tbody id="fetchDataReasons">
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
              <tbody id="fetchDataImproving_content">
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
    <!-- TABLE1 -->
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
                <th class='py-2 px-4 border-b font-k2d'>แก้ไข</th>
                <th class='py-2 px-4 border-b font-k2d'>ลบ</th>
              </tr>
            </thead>
            <tbody id="displayDataTb1">

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- TABLE2 -->
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
                <th class='py-2 px-4 border-b font-k2d'>แก้ไข</th>
                <th class='py-2 px-4 border-b font-k2d'>ลบ</th>
              </tr>
            </thead>
            <tbody id="displayDataTb2">

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
              <tbody id="fetchDatapropos_issue">
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
              <tbody id="fetchDatamati">
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
              if (result.response === '') {
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                // console.log(result.response);
                // อัปเดตข้อมูลในตาราง
                $('#data-origin').text(originInfo);
                $('#data-updated').text(updatedInfo);
                $('#data-improv').text(improvInfo);
                // location.reload();
                fetchDataTb1()
              } else {
                alert('เกิดข้อผิดพลาดในการบันทึก');
                fetchDataTb1()
                // location.reload();
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
              if (result.response === '') {
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                windlow.location.reload();
                // อัปเดตข้อมูลในตาราง
                $('#data-origin2').text(originInfo);
                $('#data-updated2').text(updatedInfo);
                $('#data-improv2').text(improvInfo);

                fetchDataTb2()
                // location.reload();
              } else {

                alert('เกิดข้อผิดพลาดในการบันทึก');
                fetchDataTb2()


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
            if (formId == 1) {
              fetchDataReasons(formId);
            } else if (formId == 2) {
              fetchDataImproving_content(formId);
            } else if (formId == 9) {
              fetchDatapropos_issue(formId);
            } else if (formId == 10) {
              fetchDatamati(formId);
            }

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
      function editAll1() {
        console.log("editAll1")
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
      };

      function editAll2() {
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
      };
      $(document).on('click', '.edit-btn', function() {
        const Id = $(this).attr('id').replace('edit', '');
        console.log("Editor ID:", Id);

        const formId = $(this).data('form-id'); // Get form ID from the button
        console.log("Form ID:", formId);

        // Fetch data for the given form ID
        $.ajax({
          url: 'fetch_data.php', // Endpoint for fetching data
          type: 'GET',
          data: {
            formId: formId,
            action: 'getform' // Specify the action
          },
          success: function(response) {
            console.log("Raw response:", response); // Debug raw response
            try {
              const result = JSON.parse(response);
              console.log("Parsed result:", result); // Debug parsed result
              if (result.response === 'success') {
                $('#' + Id).summernote('code', result.data);
              } else {
                alert(result.message || 'ไม่พบข้อมูลหรือเกิดข้อผิดพลาด');
              }
            } catch (e) {
              console.error("JSON parse error:", e.message);
              alert('Error parsing response. Please check the console for details.');
            }
          },
          error: function(xhr, status, error) {
            console.error("Error details:", {
              xhr,
              status,
              error
            });
            alert(`เกิดข้อผิดพลาด: ${status} - ${error}`);
          }
        });
      });
      $(document).on('click', '.delete-btn', function() {
        const formId = $(this).siblings('.edit-btn').data('form-id'); // Get form ID from the sibling edit button's data attribute
        console.log("Form ID for deletion:", formId);

        if (!formId) {
          // Handle deletion for multiple form IDs
          const formIds = JSON.parse($(this).attr('data-form-id'));
          console.log("Deleting records with fids:", formIds);

          if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลทั้งหมดนี้?')) {
            // Send AJAX request to delete multiple records
            $.ajax({
              type: 'POST',
              url: 'delete.php',
              data: {
                action: 'delete3form',
                formIds: formIds // Send array of form IDs
              },
              success: function(response) {
                console.log("Raw response:", response); // Debug raw response
                try {
                  const result = JSON.parse(response);
                  console.log("Parsed result:", result); // Debug parsed result
                  if (result.response === 'success') {
                    alert("ลบข้อมูลทั้งหมดแล้ว");
                    fetchDataTb1()
                    fetchDataTb2()
                  } else {
                    alert(result.message || 'เกิดข้อผิดพลาดในการลบข้อมูล');
                  }
                } catch (e) {
                  console.error("JSON parse error:", e.message);
                  alert('Error parsing response. Please check the console for details.');
                }
              },
              error: function(xhr, status, error) {
                console.error("Error details:", {
                  xhr,
                  status,
                  error
                });
                alert(`เกิดข้อผิดพลาด: ${status} - ${error}`);
              }
            });
          }
        } else {
          // Handle deletion for a single form ID
          if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')) {
            $.ajax({
              type: 'POST',
              url: 'delete.php',
              data: {
                action: 'deleteform',
                formId: formId // Send the specific form ID
              },
              success: function(response) {
                console.log("Raw response:", response); // Debug raw response
                try {
                  const result = JSON.parse(response);
                  console.log("Parsed result:", result); // Debug parsed result
                  if (result.response === 'success') {
                    alert("ลบข้อมูลแล้ว");
                    location.reload()

                  } else {
                    alert(result.message || 'เกิดข้อผิดพลาดในการลบข้อมูล');
                  }
                } catch (e) {
                  console.error("JSON parse error:", e.message);
                  alert('Error parsing response. Please check the console for details.');
                }
              },
              error: function(xhr, status, error) {
                console.error("Error details:", {
                  xhr,
                  status,
                  error
                });
                alert(`เกิดข้อผิดพลาด: ${status} - ${error}`);
              }
            });
          }
        }
      });
    </script>
</body>

</html>