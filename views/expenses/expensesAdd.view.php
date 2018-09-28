<?php include('views/partials/header.view.php') ?>
<a href="/expenses">Go back</a>
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
       <tr class="add-tax">
           <td><?php foreach ($employee as $item):  endforeach;?></td>
           <td><?php ?></td>
           <td><?php ?></td>
           <td><?php ?></td>
       </tr>
        </tbody>
    </table>
    <button onclick="addTax()">Add New</button>
    <button type="submit" class="submit">Submit</button>
</form>
</div>
<script>
    function addTax() {
        var itm = document.getElementsByClassName("add").lastChild;
        var cln = itm.cloneNode(true);
        document.getElementById("add").appendChild(cln);
    }
</script>
<?php include('views/partials/footer.view.php') ?>
