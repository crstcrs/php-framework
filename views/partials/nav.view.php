<div class="sidebar">
    <ul class="navigation">
        <li><a href="/dashboard" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'dashboard'): echo 'active'; endif; ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
        <li><a href="/projects" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'projects'): echo 'active'; endif; ?>"><i class="fa fa-archive" aria-hidden="true"></i> <span>Projects</span></a></li>
        <li><a href="/choose-project" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'tasks'): echo 'active'; endif; ?>"><i class="fa fa-tasks" aria-hidden="true"></i> <span>Tasks</span></a></li>
        <li><a href="/settings" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'settings'): echo 'active'; endif; ?>"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Settings</span></a></li>
        <li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a></li>
    </ul>
</div>