<?php use App\Code\Core\App; ?>
<div class="sidebar">
    <ul class="navigation">
        <li><a href="/dashboard" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'dashboard'): echo 'active'; endif; ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span></a></li>
        <li><a href="/attendance" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'attendance' || trim($_SERVER['REQUEST_URI'], '/') == 'startAt' ): echo 'active'; endif; ?>"><i class="fa fa-pencil" aria-hidden="true"></i> <span>Attendance</span></a></li>
        <li><a href="/timetrack" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'timetrack'): echo 'active'; endif; ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Time Tracking</span></a></li>
        <li><a href="/holiday" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'holiday'): echo 'active'; endif; ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span>Vacation</span></a></li>
    <?php if (App::get('helper')->isAdmin() || App::get('helper')->hasRights() ):?>
        <li><a href="/expenses" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'expenses' || trim($_SERVER['REQUEST_URI'], '/') == 'pay' || trim($_SERVER['REQUEST_URI'], '/') == 'expensesAdd'): echo 'active'; endif; ?>"><i class="fa fa-money" aria-hidden="true"></i> <span>Expenses</span></a></li>
    <?php endif; ?>

        <?php if (App::get('helper')->isAdmin()):?>
            <li><a href="/projects" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'projects'): echo 'active'; endif; ?>"><i class="fa fa-archive" aria-hidden="true"></i> <span>Projects</span></a></li>
        <?php endif; ?>
        <li><a href="/choose-project" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'choose-project'): echo 'active'; endif; ?>"><i class="fa fa-tasks" aria-hidden="true"></i> <span>Tasks</span></a></li>
        <li><a href="/settings" class="<?php if(trim($_SERVER['REQUEST_URI'], '/') == 'settings'): echo 'active'; endif; ?>"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Settings</span></a></li>
        <li><a href="/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a></li>
    </ul>
</div>