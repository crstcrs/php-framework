<?php include('views/partials/header.view.php') ?>
<div class="content">
    <div class="tabs is-toggle">
        <ul>
            <li class="is-active">
                <a>
                    <span class="icon is-small"><i class="fa fa-list-ol"></i></span>
                    <span>Task Statuses</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tabs-content">
        <?php foreach($statuses as $id => $status):?>
            <ul>
                <li>#<?php echo $id ?> <?php echo $status ?></li>
            </ul>
        <?php endforeach; ?>
    </div>
</div>
<?php include('views/partials/footer.view.php') ?>