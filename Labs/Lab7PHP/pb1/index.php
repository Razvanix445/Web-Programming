<!--În rezolvarea problemei de mai jos se vor efectua toate validările şi verificările necesare pentru a preîntâmpina
orice problemă de securitate (SQL injection, cross site scripting, CSRF, unrestricted file upload, etc). Nu se va
folosi JavaScript (sau librarii bazate pe JavaScript). Singurele tehnologii permise pe client sunt HTML si CSS.

1. O baza de date contine trenuri caracterizate de: nr. tren, tip tren, localitate plecare, localitate sosire, ora
plecare, ora sosire. Un calator va putea cauta trenuri intre doua localitati, specificand prin intermediul unui check
box daca doreste numai curse directe sau si curse cu legatura (schimbarea trenului intr-o localitate intermediara).-->

<?php
session_start();

function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

generate_csrf_token();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Căutare Trenuri</title>
</head>
<body>
<div class="container">
    <h1>Căutare Trenuri</h1>
    <form method="POST" action="script.php">
        <label for="plecare">Localitate Plecare:</label>
        <input type="text" id="plecare" name="plecare" required>
        <br><br>
        <label for="sosire">Localitate Sosire:</label>
        <input type="text" id="sosire" name="sosire" required>
        <br><br>
        <label for="direct">Doar curse directe:</label>
        <input type="checkbox" id="direct" name="direct">
        <br><br>
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="submit" value="Căutare">
    </form>
</div>
</body>
</html>