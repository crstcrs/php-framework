<?php include('views/partials/header.view.php') ?>
<form method="POST" action="/startAt">
    <button type="submit" class="submit">Start</button>
</form>
<table class="attendance">
    <?php
    foreach (array_reverse($dates) as $currentDate => $date):
    ?><tr><td><?php echo $currentDate; ?></td></tr><?php
    $count = 0;
    if($currentDate!=date("m.d.y")){
    if(count($date)%2!=0){
        echo "<tr><td>Wrong dates</td></tr>";
        continue;
    }}
    foreach ($date as $item):
    if ($count % 2 != 0) { ?>
        <td><?php echo "Out: " . date("Y-m-d H:i:s", $item); ?></td></tr><?php
    } else { ?>
    <tr>
        <td><?php echo "In: " . date("Y-m-d H:i:s", $item); ?></td>

        <?php } ?>
        <?php
        $count++;
        endforeach;
        endforeach; ?>
</table>
<?php include('views/partials/footer.view.php') ?>
