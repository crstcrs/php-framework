<?php include('views/partials/header.view.php') ?>
<?php  switch ($start) {
    case(null): ?><form method="post" action="/startAt">
        <button type="submit" class="submit start">Start</button>
    </form><?php
        break;
    case('first'): ?><button type="button" class="open-modal submit stop" data-action="work-description">Stop</button><?php
        break;
    default:?>
        <?php if($start % 2 == 0) : ?>
            <form method="post" action="/startAt">
                <button type="submit" class="submit start">Start</button>
            </form>
        <?php else: ?>
            <button type="button" class="open-modal submit stop" data-action="work-description">Stop</button>
        <?php endif;?>
        <?php break;
} ?>
    <div class="modal work-description">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Work description</p>
                <button class="delete close-modal" aria-label="close"></button>
            </header>
            <form method="post" action="/stopAt">
                <section class="modal-card-body">
                    <div class="descrition">
                        <input type="text" name="work-description" placeholder="Describe what you have done"/>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success">Save changes</button>
                </footer>
            </form>
        </div>
    </div>
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
                    <div class="prog-bar <?php echo $type = $times['type'] == 1 ? 'worked' : '' ?>" style="float: left;width: <?php echo $lenght ?>%; background: <?php echo $backgroundColor ?>; height: 100%;"><?php if($times['type'] == 1): ?><span class="desc"><?= $times['description']; ?></span><?php endif;?></div>
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
    <script>
        $(document).ready(function(){
            $(document.body).on('click','.prog-bar', function (){
                $(this).find(".desc").toggle('active');
            });

        });
    </script>
<?php include('views/partials/footer.view.php') ?>