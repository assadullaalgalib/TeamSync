<?php
include_once '../model/project-model.php';

$query = $_GET['query'] ?? '';
$userid = $_GET['userid'] ?? '';

$results = [];

if (!empty($query)) {
    $query = "%" . strtolower($query) . "%";
    $projects = searchClientProjects($query, $userid);
    foreach ($projects as $project) {
        $results[] = [
            'type' => 'project',
            'id' => $project['project_id'],
            'name' => $project['name'],
            'formatted_name' => $project['name'] . ' - [Project]'
        ];
    }
}

// Sort results to show best matches first
usort($results, function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

// Return the results as HTML
echo "<ul>";
foreach ($results as $result) {
    $link = "../controller/client-project-controller.php?action=view&project_id=" . $result['id'];
    echo "<li><a href='{$link}'>" . htmlspecialchars($result['formatted_name']) . "</a></li>";
}
echo "</ul>";
?>
