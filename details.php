<?php
include 'db.php';

// Obtener el ID del libro de la URL
$idLibro = $_GET['idLibro'];

// Consulta para obtener la información del libro junto con el nombre del autor
$query = "SELECT Libro.*, Autor.Nombre AS autor_nombre FROM Libro
          INNER JOIN Autor ON Libro.Autor_idAutor = Autor.idAutor
          WHERE Libro.idLibro = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idLibro]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el libro
if (!$book) {
    echo "Libro no encontrado.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Libro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        <h1 class="mb-4">Detalles del Libro</h1>
        <div class="card" style="background-color: rgba(255, 255, 255, 0.4);">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($book['Titulo']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($book['autor_nombre']); ?></h6>
                <p class="card-text"><?php echo htmlspecialchars($book['Descripcion']); ?></p>
                <p class="card-text">Páginas: <?php echo htmlspecialchars($book['Paginas']); ?></p>
                <p class="card-text">Fecha de Salida: <?php echo htmlspecialchars($book['Fecha_salida']); ?></p>
                <a href="edit.php?idLibro=<?php echo $book['idLibro']; ?>" class="btn btn-warning">Editar</a>
                <a href="delete.php?idLibro=<?php echo $book['idLibro']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?');">Eliminar</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>