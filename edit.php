<?php
include 'db.php';

$idLibro = $_GET['idLibro'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['Titulo'];
    $descripcion = $_POST['Descripcion'];
    $paginas = $_POST['Paginas'];
    $fecha_salida = $_POST['Fecha_salida'];
    $autor_id = $_POST['Autor_idAutor'];

    $query = "UPDATE Libro SET Titulo = ?, Descripcion = ?, Paginas = ?, Fecha_salida = ?, Autor_idAutor = ? WHERE idLibro = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$titulo, $descripcion, $paginas, $fecha_salida, $autor_id, $idLibro]);

    header("Location: index.php");
    exit;
}

$query = "SELECT * FROM Libro WHERE idLibro = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idLibro]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Editar Libro</title>
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
        <h1 class="mb-4">Editar Libro</h1>
        <form method="POST" action="edit.php?idLibro=<?php echo $idLibro; ?>">
            <div class="form-group">
                <label>Título:</label>
                <input type="text" name="Titulo" class="form-control" value="<?php echo htmlspecialchars($book['Titulo']); ?>" required>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="Descripcion" class="form-control" required><?php echo htmlspecialchars($book['Descripcion']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Páginas:</label>
                <input type="number" name="Paginas" class="form-control" value="<?php echo htmlspecialchars($book['Paginas']); ?>" required>
            </div>
            <div class="form-group">
                <label>Fecha de Salida:</label>
                <input type="date" name="Fecha_salida" class="form-control" value="<?php echo htmlspecialchars($book['Fecha_salida']); ?>" required>
            </div>
            <div class="form-group">
                <label>Autor:</label>
                <select name="Autor_idAutor" class="form-control" required>
                    <?php foreach ($autores as $autor) : ?>
                        <option value="<?php echo $autor['idAutor']; ?>" <?php if ($autor['idAutor'] == $book['Autor_idAutor']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($autor['Nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Libro</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary">Regresar a la Lista de Libros</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>