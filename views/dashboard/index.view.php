<?php include('views/partials/header.view.php') ?>
<?php

    if($position == 'admin') {
        echo "<div class='employees'>Employees:";
        foreach ($employees as $employee):
            echo "<br><a href='/employee'>$employee->lastname $employee->firstname</a>";


        endforeach;
        }
?>
<?php include('views/partials/footer.view.php') ?>
