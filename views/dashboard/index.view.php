<?php include('views/partials/header.view.php') ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    } );
</script>

<?php
    if($position == '1') {
        echo "<div class='employees'>Employees:";
        foreach ($employees as $employee):
            echo "<form action=\"attendance\" method=\"post\"><br><input type=\"submit\" value=\"$employee->lastname $employee->firstname\"  /><input type='hidden' value='$employee->id' name='var'/></form><form action=\"vacation\" method=\"post\"><span>Choose vacation date: <input type=\"text\" name='vacation_date' class=\"datepicker\"><input type=\"hidden\" name=\"user_id\" value=\"$employee->id\"><input type=\"submit\" value='Set' /></span></form>";
        endforeach;
        }
?>
<?php include('views/partials/footer.view.php') ?>
