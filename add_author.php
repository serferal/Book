<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];

    $query = "INSERT INTO Autor (Nombre) VALUES (?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$nombre]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Autor</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets\css\body.css">
    <link rel="stylesheet" href="assets\css\body.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"> <img src="assets\img\lina.png" alt="">
            Biblioteca</a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Agregar Libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_author.php">Agregar Autor</a>
                </li>
                <li class="nav-item">
                    <a href="authors.php" class="nav-link">Ver Lista de Autores</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Autor</h1>
        <form method="POST" action="add_author.php">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="Nombre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Autor</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>