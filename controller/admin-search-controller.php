<?php
include_once '../model/project-model.php';
include_once '../model/task-model.php';
include_once '../model/user-model.php';

header('Content-Type: application/json');

$query = $_GET['query'] ?? '';
$filter = $_GET['filter'] ?? 'all';
$userid = $_GET['userid'] ?? '';

$results = [];

if (!empty($query)) {
    $query = "%" . strtolower($query) . "%";
    
    if ($filter == 'all' || $filter == 'projects') {
        $projects = searchAllProjects($query);
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
        $tasks = searchAllTasks($query);
        foreach ($tasks as $task) {
            $results[] = [
                'type' => 'task',
                'id' => $task['task_id'],
                'name' => $task['name'],
                'formatted_name' => $task['name'] . ' - [Task]'
            ];
        }
    }
    if ($filter == 'all' || $filter == 'users') {
        $users = searchAllUsers($query);
        foreach ($users as $user) {
            $results[] = [
                'type' => 'user',
                'id' => $user['userid'],
                'name' => $user['name'],
                'formatted_name' => $user['name'] . ' - [User]'
            ];
        }
    }
    if ($filter == 'all' || $filter == 'proposals') {
        $proposals = searchAllProposals($query);
        foreach ($proposals as $proposal) {
            $results[] = [
                'type' => 'proposal',
                'id' => $proposal['project_id'],
                'name' => $proposal['name'],
                'formatted_name' => $proposal['name'] . ' - [Proposal]'
            ];
        }
    }
}

// Sort results to show best matches first
usort($results, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

// Limit the results to the first 5 items
$limitedResults = array_slice($results, 0, 5);

// Return the results as JSON
echo json_encode($limitedResults);
?>
