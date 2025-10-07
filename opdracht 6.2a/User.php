<?php
class User {
    private PDO $conn;
    public ?string $username = null;
    private ?string $password = null;

    public function __construct() {
        $this->dbConnect();
    }

    private function dbConnect(): void {
        $host = 'localhost';
        $dbname = 'loginsysteem';
        $user = 'root';
        $pass = '';

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Databaseverbinding mislukt: " . $e->getMessage());
        }
    }

    public function setPassword(string $password): void {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser(): array {
        if (empty($this->username) || empty($this->password)) {
            return ["Gebruikersnaam of wachtwoord niet ingesteld."];
        }

        try {
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->execute([':username' => $this->username]);

            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                return ["Gebruikersnaam bestaat al."];
            }

            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute([
                ':username' => $this->username,
                ':password' => $this->password
            ]);

            return [];
        } catch (PDOException $e) {
            return ["Databasefout: " . $e->getMessage()];
        }
    }

    public function loginUser(string $username, string $plainPassword): bool {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($plainPassword, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $this->username = $user['username'];
                return true;
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function isLoggedin(): bool {
        return !empty($_SESSION['username']);
    }

    public function getUser(string $username): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $this->username = $user['username'];
            return $user;
        }
        return null;
    }

    public function showUser(): void {
        echo htmlspecialchars($this->username ?? "Onbekende gebruiker");
    }

    public function logout(): void {
        session_unset();
        session_destroy();
        header("Location: login_form.php");
        exit;
    }
}
