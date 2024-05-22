<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['Titulo'];
    $descripcion = $_POST['Descripcion'];
    $paginas = $_POST['Paginas'];
    $fecha_salida = $_POST['Fecha_salida'];
    $autor_id = $_POST['Autor_idAutor'];

    $query = "INSERT INTO Libro (Titulo, Descripcion, Paginas, Fecha_salida, Autor_idAutor) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$titulo, $descripcion, $paginas, $fecha_salida, $autor_id]);

    header("Location: index.php");
    exit;
}

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
    <title>Agregar Libro</title>
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
        <h1 class="mb-4">Agregar Libro</h1>
        <form method="POST" action="add.php">
            <div class="form-group">
                <label>Título:</label>
                <input type="text" name="Titulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descripción:</label>
                <textarea name="Descripcion" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Páginas:</label>
                <input type="number" name="Paginas" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Fecha de Salida:</label>
                <input type="date" name="Fecha_salida" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Autor:</label>
                <select name="Autor_idAutor" class="form-control" required>
                    <?php foreach ($autores as $autor) : ?>
                        <option value="<?php echo $autor['idAutor']; ?>"><?php echo htmlspecialchars($autor['Nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Libro</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>