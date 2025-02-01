function setupSearch(roleid) {
    function loadDoc() {
        var xhr = new XMLHttpRequest();
        var searchQuery = document.getElementById("searchQuery").value;
        var userid = document.getElementById("userid").value; // Retrieve the userid from the hidden input

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("searchResults").innerHTML = xhr.responseText;
            }
        };

        xhr.open('GET', `../controller/dev-search-controller.php?query=${encodeURIComponent(searchQuery)}&roleid=${roleid}&userid=${userid}`, true);
        xhr.send();
    }

    document.getElementById('searchQuery').addEventListener('input', loadDoc);
}

document.addEventListener('DOMContentLoaded', function() {
    const roleid = 3; 
    setupSearch(roleid);
});
