<?php
if (!isset($_COOKIE['task_count']))
    setcookie('task_count', 0);

//add task
if (isset($_POST['add_task'])) {
    $count = $_COOKIE['task_count'];

    $task = 'u ' . $_POST['task'];
    echo($task);

    setcookie('tasks[' . $count . ']', $task);
    setcookie('task_count', $count + 1);

    header('Location: ' . $_SERVER['REQUEST_URI']);
}
//change task status
if (isset($_POST['change_task_status'])) {
    $task = $_COOKIE['tasks'][$_POST['key']];
    $task = $_POST['status'] . '' . substr($task, 2);

    setcookie('tasks[' . $_POST['key'] . ']', $task);

    header('Location: ' . $_SERVER['REQUEST_URI']);
}
//delete task
if (isset($_POST['delete_task'])) {
    setcookie('tasks[' . $_POST['key'] . ']', '', time() - 3600);
    header('Location: ' . $_SERVER['REQUEST_URI']);
}
//ready all tasks
if (isset($_POST['ready_all_tasks'])) {
    if (isset($_COOKIE['tasks'])) {
        $tasks = $_COOKIE['tasks'];
        ksort($tasks);
        foreach ($tasks as $key => $value) {
            $task = 'r ' . substr($value, 2);
            setcookie('tasks[' . $key . ']', $task);
        }
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
}
//remove all tasks
if (isset($_POST['remove_all_tasks'])) {
    if (isset($_COOKIE['tasks'])) {
        $tasks = $_COOKIE['tasks'];
        ksort($tasks);
        foreach ($tasks as $key => $value) {
            setcookie('tasks[' . $key . ']', '', time() - 3600);
        }
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
}
