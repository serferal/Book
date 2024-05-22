<?php
include 'db.php';

$query = "SELECT 
            Libro.idLibro, 
            Libro.Titulo, 
            Libro.Descripcion, 
            Libro.Paginas, 
            Libro.Fecha_salida, 
            Autor.Nombre AS autor_nombre
          FROM 
            Libro
          JOIN 
            Autor 
          ON 
            Libro.Autor_idAutor = Autor.idAutor";
$stmt = $pdo->prepare($query);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <h1 class="mb-4">Lista de Libros</h1>
        <div class="row">
            <?php foreach ($books as $book) : ?>
                <div class="col-12 col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($book['Titulo']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($book['autor_nombre']); ?></h6>
                            <p class="card-text"><?php echo htmlspecialchars($book['Descripcion']); ?></p>
                            <a href="details.php?idLibro=<?php echo $book['idLibro']; ?>" class="btn btn-primary">Detalles</a>
                            <a href="edit.php?idLibro=<?php echo $book['idLibro']; ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?idLibro=<?php echo $book['idLibro']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?');">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>