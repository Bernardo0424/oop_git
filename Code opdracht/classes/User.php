<?php
// Functie: classdefinitie User 
// Auteur: Studentnaam

class User {

    // Eigenschappen 
    public string $username = "";
    public string $email = "";
    private string $password = "";
    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function showUser() {
        echo "<br>Username: $this->username<br>";
        echo "<br>Password: $this->password<br>";
        echo "<br>Email: $this->email<br>";
    }

    public function registerUser() : array {
        $status = false;
        $errors = [];

        if ($this->username != "") {
            // Check user exist in database
            if (true) {
                array_push($errors, "Username bestaat al.");
            } else {
                // username opslaan in tabel user
                // INSERT INTO `user` (`username`, `password`, `role`) VALUES ('...', '...', '...');
                $status = true;
            } 
        }
        return $errors;
    }

    // ✅ Methode aangepast volgens opdracht
    public function validateLogin() {
        $errors = [];

        // Username leeg?
        if (empty($this->username)) {
            $errors[] = "Invalid username";
        } else {
            // Username lengte controleren (min 3 - max 50)
            if (strlen($this->username) < 3 || strlen($this->username) > 50) {
                $errors[] = "De gebruikersnaam moet tussen 3 en 50 tekens lang zijn.";
            }
        }

        // Password leeg?
        if (empty($this->password)) {
            $errors[] = "Invalid password";
        }

        return $errors;
    }

    public function loginUser(): bool {
        // Connect database

        // Zoek user in de table user met username = $this->username
        // Doe SELECT * from user WHERE username = $this->username

        // Indien gevonden EN password klopt dan sessie vullen

        // Return true indien gelukt anders false
        return true;
    }

    // Check if the user is already logged in
    public function isLoggedin(): bool {
        // Check if user session has been set
        return false;
    }

    public function getUser(string $username): bool {
        // Connect database
        // Doe SELECT * from user WHERE username = $username

        if (false) {
            //Indien gevonden eigenschappen vullen met waarden uit de SELECT
            $this->username = 'Waarde uit de database';
            return true;
        } else {
            return false;
        }   
    }

    public function logout() {
        session_start();
        // remove all session variables
        // destroy the session
    }
}
?>
