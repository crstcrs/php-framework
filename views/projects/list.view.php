<?php /** @var App\Code\Modules\Project\Models\Project $projects | getAllProjects() */ ?>
<?php include('views/partials/header.view.php') ?>
<div class="content">
    <button type="button" class="open-modal button" data-action="modal-new-project">New project</button>
    <h1>All projects</h1>
    <?php foreach ($projects as $project): ?>
        <div class="project-box">
            <div class="project-name">
                <?php echo $project->name; ?>
            </div>
            <div class="project-date">
                Deadline on <b><?php echo date('m-d-y', $project->due_date); ?></b>
            </div>
            <div class="project-budget">
                Budget <b><?php echo number_format($project->budget); ?> EUR</b>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="modal modal-new-project">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">New Project</p>
            <button class="delete close-modal" aria-label="close"></button>
        </header>
        <section class="modal-card-body">

        </section>
        <footer class="modal-card-foot">
            <button class="button is-success">Save changes</button>
            <button class="button">Cancel</button>
        </footer>
    </div>
</div>
<?php include('views/partials/footer.view.php') ?>
