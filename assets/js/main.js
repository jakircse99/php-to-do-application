//-------------- add task page -------------//

// set min date as current date
let taskDate = '';
let taskName = '';

function setDefault() {
    taskDate = document.querySelector("#date");
    taskName = document.querySelector("#task-name");

    taskDate.min = new Date().toISOString().slice(0, 10);
    taskDate.value = new Date().toISOString().slice(0, 10);
}

// validate form

function validateFrom() {
    
    if(taskName.value == '') {
        alert("Name can't be blank");
        return false;
    }else if (taskName.value.length > 50) {
        alert("Enter task name less then 50 letters");
        return false;
    }

    
}

// task delete confirmation


document.addEventListener('DOMContentLoaded', function() {
    let deleteLinks = document.querySelectorAll(".delete-btn");
    let length = deleteLinks.length;
    for(i = 0; i< length; i++) {
        deleteLinks[i].addEventListener("click", function(e) {
            if(!confirm("Are you sure?")) {
                e.preventDefault();
            }
        })
    } 
})
    

