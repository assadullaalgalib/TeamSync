/* function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var userid = document.getElementById("userid").value; // Retrieve the userid from the hidden input

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', `../controller/client-search-controller.php?query=${encodeURIComponent(searchQuery)}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 4; // Assuming roleid for Client is 4
    setupSearch(roleid);
}); */

function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var userid = document.getElementById("userid").value;

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                try {
                    var results = JSON.parse(xhr.responseText);

                    var limitedResultsHTML = '<ul>';
                    results.forEach(result => {
                        var link = `../controller/client-project-controller.php?action=view&project_id=${result.id}`;
                        limitedResultsHTML += `<li><a href="${link}">${result.formatted_name}</a></li>`;
                    });
                    limitedResultsHTML += '</ul>';

                    document.getElementById("searchResults").innerHTML = limitedResultsHTML;
                } catch (e) {
                    document.getElementById("searchResults").innerHTML = "<p>No results found.</p>";
                }
            }
        };

        xhr.open('GET', `../controller/client-search-controller.php?query=${encodeURIComponent(searchQuery)}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 4;
    setupSearch(roleid);
});
