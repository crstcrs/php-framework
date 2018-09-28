<?php include('views/partials/header.view.php') ?>
    <link rel="stylesheet" type="text/css" href="/assets/css/dcalendar.picker.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="/assets/js/dcalendar.picker.js"></script>
    <div class="calendar_container">
        <table id="calendar-demo"></table>
    </div>
    <script>
        $('#calendar-demo').dcalendar(); //creates the calendar
    </script>
<?php include('views/partials/footer.view.php') ?>