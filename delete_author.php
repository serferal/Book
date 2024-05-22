<?php
include 'db.php';

$idAutor = $_GET['idAutor'];

// Primero, eliminar los libros asociados a este autor
$queryDeleteBooks = "DELETE FROM Libro WHERE Autor_idAutor = ?";
$stmtDeleteBooks = $pdo->prepare($queryDeleteBooks);
$stmtDeleteBooks->execute([$idAutor]);

// Luego, eliminar el autor
$queryDeleteAuthor = "DELETE FROM Autor WHERE idAutor = ?";
$stmtDeleteAuthor = $pdo->prepare($queryDeleteAuthor);
$stmtDeleteAuthor->execute([$idAutor]);

header("Location: authors.php");
exit;
?>
