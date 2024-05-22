<?php
include 'db.php';

$idLibro = $_GET['idLibro'];

$query = "DELETE FROM Libro WHERE idLibro = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idLibro]);

header("Location: index.php");
exit;
?>
