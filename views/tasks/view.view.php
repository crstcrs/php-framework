<?php /** @var App\Code\Modules\Task\Models\Task $data | getBoardTasks() */ ?>
<?php include('views/partials/header.view.php') ?>
    <div class="content">
        <button type="button" class="open-modal button" data-action="modal-new-task">New task</button>
        <div id="board">
            <?php foreach ($data['tasks'] as $statusId => $taskList): ?>
                <div class="kanban-col">
                    <h2><?php echo $data['statuses'][$statusId] ?></h2>
                    <div class="kanban-col-<?php echo $statusId ?> kanban-sortable">
                        <?php foreach ($taskList as $task): ?>
                            <div class="task">
                                <?php echo '#' . $task->id . ' ' . $task->title; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="modal modal-new-task">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">New Task</p>
                <button class="delete close-modal" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <label for=""></label>
                <input type="text">
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>
<?php include('views/partials/footer.view.php') ?>