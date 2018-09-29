<?php include('views/partials/header.view.php') ?>
<a class="back" href="/expenses">Go back</a>
<div class="table-container">
<div class="table-title">Current month: <?php echo date("m F"); ?></div>
<form method="POST" action="/expensesAdd">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Month</th>
            <th>CAM</th>
            <th>CAS/CASS</th>
        </tr>
        </thead>
        <tbody id="add">
       <tr class="first">
           <td><select name="user_id[]"><?php foreach ($employee as $item): ?><option value="<?php  echo $item['id']; ?>"><?php echo $item['name']; ?></option> <?php endforeach;?></select></td>
           <td><select name="month[]">
                   <?php
                   for($m=1; $m<=12; ++$m) {
                       echo date('F', mktime(0, 0, 0, $m, 1)) . '<br>';
                       ?>
                       <option value="<?php echo sprintf("%02d", $m);?>" <?php if(isset($_POST['month']) && $_POST['month'] == sprintf("%02d", $m)){ echo 'selected';}elseif(!isset($_POST['month']) && $m == date ('m')){echo 'selected';} ?>><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                       <?php
                   }
                   ?>
               </select></td>
           <td><input type="number" name="CAM[]" /> lei</td>
           <td><input type="number" name="CAS[]" /> lei</td>
           <td class="remove"><i class="remove fa fa-remove" aria-hidden="true"></i></td>
       </tr>
        </tbody>
    </table>
    <i class="add-tax fa fa-plus" aria-hidden="true"></i>
    <button type="submit" class="submit">Submit</button>
</form>
</div>
<script>
        $(document).ready(function(){
            $('tr:eq(1) > td.remove').css('display','none');
            $(".add-tax").click(function(){
                $( "#add tr:first-child" ).clone().appendTo( "#add" ).removeClass('first').addClass('child');
                $('.child > td.remove').css('display','table-cell');
            });
            $('#add').on('click', '.remove', function(){
                $(this).closest ('tr').remove ();
            });
            $("input").prop('required',true);
        });
</script>
<?php include('views/partials/footer.view.php') ?>
