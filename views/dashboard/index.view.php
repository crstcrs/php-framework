<?php include('views/partials/header.view.php') ?>
<form action="attendance" method="post">
<?php
    if($position == 'admin') {
        echo "<div class='employees'>Employees:";
        foreach ($employees as $employee):
            echo "<br><input type=\"submit\" value=\"$employee->id\" name=\"var\" />$employee->lastname $employee->firstname";

        endforeach;
        }
?>
</form>
<?php include('views/partials/footer.view.php') ?>
