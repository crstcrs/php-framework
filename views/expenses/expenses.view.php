<?php include('views/partials/header.view.php') ?>
<div class="table-container">
    <div class="table-title">Current month: <?php echo date("m F"); ?></div>
    <form id="filter" method="POST" action="/expenses">
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
    </form>
    <a href="/expensesAdd">Add Tax</a>
    <form method="POST" action="/pay">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>CAM</th>
            <th>CAS/CASS</th>
            <th>Paid</th>
        </tr>
        </thead>
        <tbody>
<?php
    $month = $thisMonth;
    $i = 1;
    $totalCAM = $totalCAS = $remainingCAM = $remainingCAS =  0;
    foreach ($taxes as $tax):
        $totalCAM += $tax['tax1'] ;
        $totalCAS += $tax['tax2'] ;
        $remainingCAM += $tax['paid'] ? 0 :$tax['tax1'] ;
        $remainingCAS += $tax['paid'] ? 0 :$tax['tax2'] ;
    echo '<tr><td>'.$i.'</td><td>'.$tax['name'].'</td><td>'.$tax['tax1'].' lei</td><td>'.$tax['tax2'].' lei</td>';
        ?><td><input type="checkbox" name='check_list[<?php echo $tax['id']; ?>]' <?php echo $checks = $tax['paid'] ? 'checked':''; ?> value="<?php echo '1'; ?>" /></td></tr>
    <?php $i++;endforeach; ?>
    <tr><td>-</td><td>Total</td><td><?php echo $totalCAM; ?></td><td><?php echo $totalCAS; ?></td><td><strong><?php echo $totalCAS + $totalCAM; ?></strong></td></tr>
<tr><td>-</td><td>Total Remaining</td><td><?php echo $remainingCAM; ?></td><td><?php echo $remainingCAS; ?></td><td><strong><?php echo $remainingCAM + $remainingCAS; ?></strong></td></tr>
        </tbody>
    </table>
        <input type="hidden" name="month" value="<?php echo $month; ?>">
        <button type="submit" class="submit">Submit</button>
    </form>
</div>
<?php include('views/partials/footer.view.php') ?>
