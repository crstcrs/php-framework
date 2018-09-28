<?php include('views/partials/header.view.php') ?>
<form method="POST" action="/startAt">
    <button type="submit" class="submit">Start</button>
</form>
<form id="foo" method="POST" action="">
    <label >Filter</label>
    <select name="month" onchange='if(this.value != 0) { this.form.submit(); }'>
        <?php
        for($m=1; $m<=12; ++$m) {
            echo date('F', mktime(0, 0, 0, $m, 1)) . '<br>';
            ?>
            <option value="<?php echo sprintf("%02d", $m);?>" <?php if(isset($_POST['month']) && $_POST['month'] == sprintf("%02d", $m)){ echo 'selected';}elseif(!isset($_POST['month']) && $m == date ('m')){echo 'selected';} ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
            <?php
        }
        ?>
    </select>
    <?php if(isset($_POST['id'])){
        echo "<input type='hidden' name='id' value='".$_POST['id']."'>";
    }?>
</form>
<div class="table-container">
    <div class="table-title">Current date: <?php echo date("d.m.Y"); ?></div>
<table>
    <thead>
    <tr>
        <th>Day</th>
        <th>Attendance</th>
        <th>Worked</th>
        <th>Remaining</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $totalWorked = 0;
        $totalRemaining = 0;
        foreach (array_reverse($dates) as $currentDate => $date):
            if(date('Y-m-d',strtotime($currentDate)) > date('Y-m-d')){
                continue;
            }
            $totalHours = 0;
            $worked = 0;
            $remaining = 0;
            echo "<tr><td>".$currentDate."</td>";
            if (isset($date['worked'])){
            foreach($date['worked'] as $times) {
                $totalHours += $times['value'];
            }
            ?><?php
            ?><td style="vertical-align: middle"><div class="progress-bar progress">
                <?php foreach($date['worked'] as $times):
                    if ($times['type'] == 1){
                        $worked += $times['value'];
                    }
                    if($totalHours==0){
                        $lenght = 0;
                    }else{
                        $lenght = ($times['value']*100) / $totalHours;}
                    $backgroundColor = ($times['type'] == 0) ? '#ff0000' : '#00e600';
                    ?>
                    <div style="float: left;width: <?php echo $lenght ?>%; background: <?php echo $backgroundColor ?>; height: 100%;"></div>
                <?php
                endforeach; ?></div></td><td class="total-worked"><?php $totalWorked += $worked; echo gmdate("H:i:s", $worked); ?> </td><td><?php
                    if(isset($date['weekend'])){echo "Weekend";}else{ $remaining = 28800 - $worked ; $totalRemaining += $remaining; echo gmdate("H:i:s", $remaining );}?></td></tr>
        <?php
            }
            else{
                if(isset($date['vacation'])){
                    echo "<td style=\"vertical-align: middle\"><div class=\"progress-bar progress\"><div style=\"float: left;width: 100%; background: #ffffff; height: 100%;\"></div></div></td><td> Vacation </td><td> Vacation </td></tr>";
                }elseif(isset($date['weekend'])){
                    $totalWorked += $worked;
                    echo "<td style=\"vertical-align: middle\"><div class=\"progress-bar progress\"><div style=\"float: left;width: 100%; background: #ffffff; height: 100%;\"></div></div></td><td>".gmdate('H:i:s', $worked )."</td><td> Weekend </td></tr>";
                }else{
                    $totalWorked += $worked;
                    $remaining = 28800 - $worked ;
                    $totalRemaining += $remaining;
                    echo "<td style=\"vertical-align: middle\"><div class=\"progress-bar progress\"><div style=\"float: left;width: 100%; background: #777; height: 100%;\"></div></div></td><td>".gmdate('H:i:s', $worked )."</td><td>".gmdate('H:i:s',$remaining )."</td></tr>";
                }
            }
        endforeach;
            echo "<tr><td> Total </td><td> - </td><td>".number_format($totalWorked/3600,1)." hours</td><td>".number_format($totalRemaining/3600,1)." hours</td></tr>";
            ?>

    </tbody>
</table>
</div>
<?php

 ?>

<?php include('views/partials/footer.view.php') ?>