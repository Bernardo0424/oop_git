<?php
// User.php - gebruikerslogica (geen redirects hier!)
declare(strict_types=1);

class User
{
    private PDO $conn;
    public ?string $username = null;

    public function __construct(PDO $pdo)
    {
        $this->conn = $pdo;
    }

    public function registerUser(string $username, string $plainPassword): array
    {
        $username = trim($username);

        if ($username === '' || $plainPassword === '') {
            return ['Gebruikersnaam of wachtwoord niet ingesteld.'];
        }

        if (strlen($plainPassword) < 6) {
            return ['Wachtwoord moet minstens 6 tekens bevatten.'];
        }

        try {
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);

            if ($stmt->fetch()) {
                return ['Gebruikersnaam bestaat al.'];
            }

            $hashed = password_hash($plainPassword, PASSWORD_DEFAULT);

            $stmt = $this->conn->prepare(
                "INSERT INTO users (username, password) VALUES (:username, :password)"
            );
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashed,
            ]);

            return [];
        } catch (PDOException $e) {
            return ['Databasefout: ' . $e->getMessage()];
        }
    }

    public function loginUser(string $username, string $plainPassword): bool
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($plainPassword, $user['password'])) {
                $this->username = $user['username'];
                return true;
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getUser(string $username): ?array
    {
        $stmt = $this->conn->prepare("SELECT id, username FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user) {
            $this->username = $user['username'];
            return $user;
        }
        return null;
    }

    public function isLoggedin(): bool
    {
        return !empty($_SESSION['username']);
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
    }
}
