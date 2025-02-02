function setupSearch() {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var searchFilter = document.getElementById("searchFilter").value;
        var userid = document.getElementById("userid").value;

        console.log("Making request to server with query:", searchQuery, "filter:", searchFilter, "userid:", userid); // Debugging statement

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("Response received from server:", xhr.responseText); // Debugging statement
                try {
                    var results = JSON.parse(xhr.responseText);

                    // Limit the results to the first 5 items
                    var limitedResults = results.slice(0, 5);

                    var limitedResultsHTML = '<ul>';
                    limitedResults.forEach(result => {
                        var link = "";
                        switch (result.type) {
                            case 'project':
                                link = "../controller/admin-project-controller.php?action=view_project&project_id=" + result.id;
                                break;
                            case 'task':
                                link = "../controller/admin-task-controller.php?action=view&task_id=" + result.id;
                                break;
                            case 'user':
                                link = "../controller/admin-user-controller.php?action=view_user&userid=" + result.id;
                                break;
                            case 'proposal':
                                link = "../controller/admin-project-controller.php?action=view_proposal&project_id=" + result.id;
                                break;
                        }
                        limitedResultsHTML += `<li><a href="${link}">${result.formatted_name}</a></li>`;
                    });
                    limitedResultsHTML += '</ul>';

                    document.getElementById("searchResults").innerHTML = limitedResultsHTML;
                } catch (e) {
                    document.getElementById("searchResults").innerHTML = "<p>No results found.</p>";
                }
            }
        };

        xhr.open('GET', `../controller/admin-search-controller.php?query=${encodeURIComponent(searchQuery)}&filter=${searchFilter}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
    document.getElementById('searchFilter').addEventListener('change', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    setupSearch();
});
