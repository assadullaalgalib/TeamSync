function validateProposalForm(event) {
    event.preventDefault();
    var proposalname = document.getElementById('proposalname');
    var description = document.getElementById('description');
    var proposaldeadline = document.getElementById('proposaldeadline');

    var nameError = document.getElementById('nameError');
    var descriptionError = document.getElementById('descriptionError');
    var deadlineError = document.getElementById('deadlineError');

    let valid = true;

    if (!proposalname.value) {
        nameError.innerHTML = 'Project name is required.';
        valid = false;
    } else {
        nameError.innerHTML = '';
    }

    if (!description.value) {
        descriptionError.innerHTML = 'Project description is required.';
        valid = false;
    } else {
        descriptionError.innerHTML = '';
    }

    if (!proposaldeadline.value) {
        deadlineError.innerHTML = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

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
