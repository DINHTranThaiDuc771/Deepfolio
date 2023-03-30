<html>
    <head>
        <title>Créer un compte</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            $servername = "localhost";
            $username = "lp212835";
            $password = "1234";

            $conn = new mysqli($servername, $username, $password);

            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
        ?>

        <h2>Creer un compte</h2>

        <form>
            <input type="text" name="nom" id="nom" required>
   
            <input type="email" name="email" id="email" required>

            <input type="password" name="mdp" id="mdp" required>

            <input type="submit" value="Creer">
        </form>
    </body>
</html>