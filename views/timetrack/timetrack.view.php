<?php include('views/partials/header.view.php') ?>
<h1><time>00:00:00</time></h1>
<button id="start">start</button>
<button id="stop">stop</button>

<select>
<?php
foreach ($tasks as $task):
    echo "<option value='$task->id'>$task->title</option>";

endforeach;?>
</select>Description: <input type='text' name='description'>
<script>
    var h1 = document.getElementsByTagName('h1')[0],
        start = document.getElementById('start'),
        stop = document.getElementById('stop'),
        seconds = 0, minutes = 0, hours = 0,
        t;

    function add() {
        seconds++;
        if (seconds >= 60) {
            seconds = 0;
            minutes++;
            if (minutes >= 60) {
                minutes = 0;
                hours++;
            }
        }

        h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

        timer();
    }
    function timer() {
        t = setTimeout(add, 1000);
    }

    /* Start button */
    start.onclick = timer;

    /* Stop button */
    stop.onclick = function() {
        clearTimeout(t);
    }
</script>
<?php include('views/partials/footer.view.php') ?>