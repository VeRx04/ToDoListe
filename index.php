<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo-Liste</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>ToDo-Liste</h1>
        <form id="task-form">
            <input type="text" id="task-input" placeholder="Neue Aufgabe hinzufügen..." required>
            <button type="submit">Hinzufügen</button>
        </form>
        <ul id="task-list"></ul>
    </div>

    <script src="script.js"></script>
</body>
</html>