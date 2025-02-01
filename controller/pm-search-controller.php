<?php
include_once '../model/project-model.php';
include_once '../model/task-model.php';
include_once '../model/user-model.php';

header('Content-Type: application/json');

$query = $_GET['query'] ?? '';
$filter = $_GET['filter'] ?? 'all';
$roleid = $_GET['roleid'] ?? '';
$userid = $_GET['userid'] ?? '';

$results = [];

if (!empty($query)) {
    $query = "%" . strtolower($query) . "%";
    
    if ($filter == 'all' || $filter == 'projects') {
        $projects = searchPMProjects($query, $userid);
        foreach ($projects as $project) {
            $results[] = [
                'type' => 'project',
                'id' => $project['project_id'],
                'name' => $project['name'],
                'formatted_name' => $project['name'] . ' - [Project]'
            ];
        }
    }
    if ($filter == 'all' || $filter == 'tasks') {
        $tasks = searchPMTasks($query, $userid);
        foreach ($tasks as $task) {
            $results[] = [
                'type' => 'task',
                'id' => $task['task_id'],
                'name' => $task['name'],
                'formatted_name' => $task['name'] . ' - [Task]'
            ];
        }
    }
}

// Sort results to show best matches first
usort($results, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});



/* // Return the results as HTML
foreach ($results as $result) {
    echo "<ul>";
    $link = "";
    switch ($result['type']) {
        case 'project':
            $link = "../controller/pm-project-controller.php?action=view&project_id=" . $result['id'];
            break;
        case 'task':
            $link = "../controller/pm-task-controller.php?action=view&task_id=" . $result['id'];
            break;
    }
    echo "<li><a href='{$link}'>" . htmlspecialchars($result['formatted_name']) . "</a></li>";
    echo "</ul>";
}
 */

 // Limit the results to the first 5 items
$limitedResults = array_slice($results, 0, 5);

// Return the results as JSON
echo json_encode($limitedResults);
?>