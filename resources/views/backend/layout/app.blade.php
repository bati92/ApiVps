 
<!doctype html>
<html lang="en">

<head>
<title>ITS</title>
<!-- <title>@yield('title', )</title> -->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/nestable/jquery-nestable.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/charts-c3/plugin.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

<style>
    :root {
    --primary-color: #34c2b1;
    --secondary-color:#e0455a;
    --primary-gradient: linear-gradient(45deg, #34c2b1, #e0455a);
    }
    body{
        font-size:16px !important
    }
    .my .input-group-text{
        width:150px;
       text-align:center !important
    }
    #notificationsList li {
        padding:10px;
        border-bottom:1px solid #e9e9e9

    }

    </style>
<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<style>
   
@import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&display=swap');
body.font-nunito {
    font-family: "El Messiri", sans-serif;


    }

    </style>

</head>

<body data-theme="light" class="font-nunito rtl_mode">
  <div id="wrapper" class="">
    @if(auth()->user()->role!=4)

@include('backend.layout.header')

@include('backend.layout.left-aside')
@yield('content')
  @endif
  </div>

<script>
    // وظيفة لجلب الإشعارات غير المقروءة
    function fetchNotifications() {
        fetch('https://api.its-server.online/admin/unread-notifications'
        )
            .then(response => response.json())
            .then(data => {
                console.log(data); // عرض البيانات في الكونسول لتصحيح الأخطاء
          
                let notificationsList = document.getElementById('notificationsList');
                notificationsList.innerHTML = ""; // تفريغ الإشعارات القديمة

                data.forEach(notification => {
                    let listItem = document.createElement('li');
                    listItem.textContent = notification.data.message;
                    notificationsList.appendChild(listItem);
                });
            });
    }

    // تحديث الإشعارات كل 10 ثواني
    setInterval(fetchNotifications, 10000);

    // جلب الإشعارات عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', fetchNotifications);
</script>
    <!-- Javascript -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>    
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>

<script src="{{ asset('assets/vendor/nestable/jquery.nestable.js') }}"></script> <!-- Jquery Nestable -->
<script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('assets/bundles/knob.bundle.js') }}"></script> <!-- Jquery Knob-->

<!-- page js file -->
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<script src="{{ asset('js/pages/ui/sortable-nestable.js') }}"></script>
<script src="{{ asset('js/pages/tables/jquery-datatable.js') }}"></script>
<script src="{{ asset('js/index6.js') }}"></script>
</body>
