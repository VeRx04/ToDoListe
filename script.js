// Wartet bis DOM geladen ist
document.addEventListener('DOMContentLoaded', function(){
    loadTasks();

    document.querySelector('#task-form').onsubmit = function(e){
        e.preventDefault();
        let taskInput = document.querySelector('#task-input');
        let task = taskInput.value.trim();

        if(task){
            fetch('tasks.php', {
                method: 'POST',
                headers: {'Content-Type':'application/json'},
                body: JSON.stringify({action:'add', task:task})
            }).then(loadTasks);
            taskInput.value = '';
        }
    };
});

// Lädt alle Aufgaben
function loadTasks(){
    fetch('tasks.php').then(res=>res.json()).then(data=>{
        let taskList = document.querySelector('#task-list');
        taskList.innerHTML = '';
        data.forEach(task => {
            let li = document.createElement('li');
            li.innerHTML = `
                <span onclick="toggleTask('${task.id}')" ${task.completed ? 'style="text-decoration: line-through;"' : ''}>
                    ${task.text}
                </span>
                <button onclick="deleteTask('${task.id}')">×</button>
            `;
            taskList.appendChild(li);
        });
    });
}

// Ermöglich das Markieren von Aufgaben als "erledigt" oder "nicht erledigt"
function toggleTask(id){
    fetch('tasks.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({action:'toggle', id:id})
    }).then(loadTasks);
}

// Löschen einer Aufgabe
function deleteTask(id){
    fetch('tasks.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({action:'delete', id:id})
    }).then(loadTasks);
}
