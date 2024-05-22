<?php
include 'db.php';

$query = "SELECT * FROM Autor";
$stmt = $pdo->prepare($query);
$stmt->execute();
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
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
        <h1 class="mb-4">Lista de Autores</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $autor) : ?>
                    <tr>
                        <td style="background-color: rgba(255, 255, 255, 0.4);"><?php echo htmlspecialchars($autor['Nombre']); ?></td>
                        <td style="background-color: rgba(255, 255, 255, 0.4);">
                            <a href="edit_author.php?idAutor=<?php echo $autor['idAutor']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="delete_author.php?idAutor=<?php echo $autor['idAutor']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este autor y todos sus libros?');">Eliminar</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>