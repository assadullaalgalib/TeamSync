
<?php
include_once '../model/project-model.php';

header('Content-Type: application/json');

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

// Limit the results to the first 5 items
$limitedResults = array_slice($results, 0, 5);

// Return the results as JSON
echo json_encode($limitedResults);
?>

