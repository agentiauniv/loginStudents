<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Configuration Supabase (Session Pooler)
    $host = "aws-1-eu-central-1.pooler.supabase.com";
    $port = "5432";
    $dbname = "postgres";
    $user = "postgres.uhqqzlpaybcyxrepisgi";
    $password_db = "Agentia2026";

    // Connexion PostgreSQL
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password_db");

    if (!$conn) {
        die("Erreur : connexion à la base impossible.");
    }

    // Données formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête sécurisée
    $query = "SELECT * FROM login WHERE email = $1 AND password = $2";
    $result = pg_query_params($conn, $query, array($email, $password));

    if ($result && pg_num_rows($result) > 0) {
        $message = "<p style='color:green;'>Connexion réussie ✅</p>";
    } else {
        $message = "<p style='color:red;'>Email ou mot de passe incorrect ❌</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Supabase</title>
</head>
<body>

<h2>Connexion</h2>

<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Mot de passe:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<?php echo $message; ?>

</body>
</html>
