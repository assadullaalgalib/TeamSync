function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value.trim();
        var searchFilter = document.getElementById("searchFilter").value;
        var useridElement = document.getElementById("userid");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', `../controller/pm-search-controller.php?query=${encodeURIComponent(searchQuery)}&filter=${searchFilter}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    // Add event listeners for live search updates
    document.getElementById('searchQuery').addEventListener('input', loadDoc);
    document.getElementById('searchFilter').addEventListener('change', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 2;  // Make sure this matches the correct role ID for your use case
    setupSearch(roleid);
});
