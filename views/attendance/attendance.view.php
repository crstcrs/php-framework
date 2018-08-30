<?php include('views/partials/header.view.php') ?>
<form method="POST" action="/startAt">
    <button type="submit" class="submit">Start</button>
</form>
<div class="attendance" style="float: left; width: 80%">
    <?php

    foreach ($dates as $currentDate => $date):
        $totalHours = 0;
        $worked = 0;
         foreach($date as $times) {
             $totalHours += $times['value'];
         }
         echo "<div class='date-d'>$currentDate</div>";
        ?><div class="progress-bar" style="max-width: 50%;">
        <?php foreach($date as $times):
        if ($times['type'] == 1){
            $worked += $times['value'];
        }
        if($totalHours==0){
            $lenght = 0;
        }else{
        $lenght = ($times['value']*100) / $totalHours;}
        $backgroundColor = ($times['type'] == 0) ? 'grey' : 'green';
        ?>
            <div style="float: left;width: <?php echo $lenght ?>%; background: <?php echo $backgroundColor ?>; height: 10px;"></div>
        <?php

    endforeach; ?></div><div class="total-worked">Worked: <?php echo gmdate("H:i:s", $worked); ?> </div>
    <?php endforeach; ?>
</div>
<?php include('views/partials/footer.view.php') ?>
