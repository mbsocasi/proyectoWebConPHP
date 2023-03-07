<?php
$usuario_correcto = "admin";
$palabra_secreta_correcta = "admin";
$usuario = $_POST["usuario"];
$palabra_secreta = $_POST["palabra_secreta"];
if ($usuario === $usuario_correcto && $palabra_secreta === $palabra_secreta_correcta) {
    session_start();
    $_SESSION["usuario"] = $usuario;
    header("Location: clientes.php");
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.html';</script>";
}
?>