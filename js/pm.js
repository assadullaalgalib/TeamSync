/* function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var searchFilter = document.getElementById("searchFilter").value;
        var userid = document.getElementById("userid").value;

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', `../controller/pm-search-controller.php?query=${encodeURIComponent(searchQuery)}&filter=${searchFilter}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
    document.getElementById('searchFilter').addEventListener('change', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 2;
    setupSearch(roleid);
}); */


function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var searchFilter = document.getElementById("searchFilter").value;
        var userid = document.getElementById("userid").value;

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var results = JSON.parse(xhr.responseText);

                    // Limit the results to the first 5 items
                    var limitedResults = results.slice(0, 5);

                    var limitedResultsHTML = '<ul>';
                    limitedResults.forEach(result => {
                        var link = "";
                        switch (result.type) {
                            case 'project':
                                link = "../controller/pm-project-controller.php?action=view&project_id=" + result.id;
                                break;
                            case 'task':
                                link = "../controller/pm-task-controller.php?action=view&task_id=" + result.id;
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

        xhr.open('GET', `../controller/pm-search-controller.php?query=${encodeURIComponent(searchQuery)}&filter=${searchFilter}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
    document.getElementById('searchFilter').addEventListener('change', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 2;
    setupSearch(roleid);
});



