<?php /** @var App\Code\Modules\Project\Models\Project $projects | getAllProjects() */ ?>
<?php include('views/partials/header.view.php') ?>
<div class="content">
    <h1>Choose a project to view all tasks</h1>
    <?php foreach ($projects as $project): ?>
        <a href="/board/<?php echo $project->id; ?>">
            <div class="project-box">
                <div class="project-name">
                    <?php echo $project->name; ?>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>
<?php include('views/partials/footer.view.php') ?>
