function validateEditProjectForm(event) {
    event.preventDefault();
    var project_name = document.getElementById('project_name');
    var description = document.getElementById('description');
    var start_date = document.getElementById('start_date');
    var deadline = document.getElementById('deadline');

    var projectNameError = document.getElementById('projectNameError');
    var descriptionError = document.getElementById('descriptionError');
    var startDateError = document.getElementById('startDateError');
    var deadlineError = document.getElementById('deadlineError');

    let valid = true;

    if (!project_name.value) {
        projectNameError.innerHTML = 'Project name is required.';
        valid = false;
    } else {
        projectNameError.innerHTML = '';
    }

    if (!description.value) {
        descriptionError.innerHTML = 'Description is required.';
        valid = false;
    } else {
        descriptionError.innerHTML = '';
    }

    if (!start_date.value) {
        startDateError.innerHTML = 'Start date is required.';
        valid = false;
    } else {
        startDateError.innerHTML = '';
    }

    if (!deadline.value) {
        deadlineError.innerHTML = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validateAddTaskForm(event) {
    event.preventDefault();
    var task_name = document.getElementById('task_name');
    var task_description = document.getElementById('task_description');
    var start_date = document.getElementById('start_date');
    var deadline = document.getElementById('deadline');

    var taskNameError = document.getElementById('taskNameError');
    var taskDescriptionError = document.getElementById('taskDescriptionError');
    var startDateError = document.getElementById('startDateError');
    var deadlineError = document.getElementById('deadlineError');

    let valid = true;

    if (!task_name.value) {
        taskNameError.innerHTML = 'Task name is required.';
        valid = false;
    } else {
        taskNameError.innerHTML = '';
    }

    if (!task_description.value) {
        taskDescriptionError.innerHTML = 'Task description is required.';
        valid = false;
    } else {
        taskDescriptionError.innerHTML = '';
    }

    if (!start_date.value) {
        startDateError.innerHTML = 'Start date is required.';
        valid = false;
    } else {
        startDateError.innerHTML = '';
    }

    if (!deadline.value) {
        deadlineError.innerHTML = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validateTaskEditForm(event) {
    event.preventDefault();
    var task_name = document.getElementById('task_name');
    var task_description = document.getElementById('task_description');
    var start_date = document.getElementById('start_date');
    var deadline = document.getElementById('deadline');

    var taskNameError = document.getElementById('taskNameError');
    var taskDescriptionError = document.getElementById('taskDescriptionError');
    var startDateError = document.getElementById('startDateError');
    var deadlineError = document.getElementById('deadlineError');

    let valid = true;

    if (!task_name.value) {
        taskNameError.innerHTML = 'Task name is required.';
        valid = false;
    } else {
        taskNameError.innerHTML = '';
    }

    if (!task_description.value) {
        taskDescriptionError.innerHTML = 'Task description is required.';
        valid = false;
    } else {
        taskDescriptionError.innerHTML = '';
    }

    if (!start_date.value) {
        startDateError.innerHTML = 'Start date is required.';
        valid = false;
    } else {
        startDateError.innerHTML = '';
    }

    if (!deadline.value) {
        deadlineError.innerHTML = 'Deadline is required.';
        valid = false;
    } else {
        deadlineError.innerHTML = '';
    }

    if (valid) {
        event.target.submit();
    }
}

function validatePMCommentsTaskForm(event) {
    var pm_comment = document.getElementById('pm_comment');
    var commentError = document.getElementById('commentError');
    let valid = true;

    if (event.submitter.name === 'action' && event.submitter.value === 'approve' && !pm_comment.value.trim()) {
        commentError.innerHTML = 'Comment is required for approval.';
        valid = false;
    } else {
        commentError.innerHTML = '';
    }

    if (valid) {
        return true;
    } else {
        event.preventDefault();
        return false;
    }
}

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



