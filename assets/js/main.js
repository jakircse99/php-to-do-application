// add task page

// set min date as current date

let taskDate = document.querySelector("#date");
let taskName = document.querySelector("#task-name");

taskDate.min = new Date().toISOString().slice(0, 10);
taskDate.value = new Date().toISOString().slice(0, 10);

// validate form

function validateFrom() {
    if(taskName.value == '') {
        alert("Name can't be blank");
    }else if (taskName.value.length > 50) {
        alert("Enter task name less then 50 letters");
    }

    return false;
}