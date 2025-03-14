<?php
$file = 'tasks.json';
$tasks = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Aufgaben als JSON zurückgeben
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo json_encode($tasks);
}

// POST-Anfrage verarbeiten
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);

    // Aufgabe hinzufügen
    if($data['action'] == 'add'){
        $tasks[] = ['id'=>uniqid(), 'text'=>$data['task'], 'completed'=>false];
    }

    // Aufgabe als "erledigt"/"nicht erledigt" umschalten
    if($data['action'] == 'toggle'){
        foreach($tasks as &$task){
            if($task['id'] == $data['id']){
                $task['completed'] = !$task['completed'];
            }
        }
    }

    // Aufgabe löschen
    if($data['action'] == 'delete'){
        foreach($tasks as $key => $task){
            if($task['id'] == $data['id']){
                unset($tasks[$key]);
            }
        }
        $tasks = array_values($tasks);
    }

    // Speichern aktualisierter Aufgaben mit entsprechender Formatierung
    file_put_contents($file, json_encode($tasks, JSON_PRETTY_PRINT));
    echo json_encode($tasks);
}
?>