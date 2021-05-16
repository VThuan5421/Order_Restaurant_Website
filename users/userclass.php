<?php
class UserClass {
    /**
     * Xử lý User đăng nhập
     */
    public function userLogin($username, $password) {
        $pdo = pdo_connect_mysql();
        //$hash_password = hash('sha256', $password);
        $hash_password = $password;
        $stmt = $pdo->prepare("SELECT user_id from users WHERE email=:username AND password=:hash_password");
        $stmt->bindParam("username", $username, PDO::PARAM_STR);
        $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        $pdo = null;
        if ($count) {
            $_SESSION['userId'] = $data->user_id;
            return true;
        }
        else {
            return false;
        }
    }
    //XỬ lý đăng ký
    public function userRegistration($username, $password, $email, $name) {
        try {
            $pdo = pdo_connect_mysql();
            $st = $pdo->prepare("SELECT user_id FROM users WHERE username=:username OR email=:email");
            $st->bindParam("username", $username, PDO::PARAM_STR);
            $st->bindParam("email", $email, PDO::PARAM_STR);
            $st->execute();
            $count = $st->rowCount();
            if ($count < 1) {
                $stmt = $pdo->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                //$hash_password = hash('sha256', $password);
                $hash_password = $password;
                $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
                $stmt->bindParam("email", $email, PDO::PARAM_STR);
                $stmt->bindParam("name", $name, PDO::PARAM_STR);
                $stmt->execute();
                $id = $pdo->lastInsertId();
                $pdo = null;
                $_SESSION['userId'] = $id;
                return true;
            } else {
                $pdo = null;
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    public function userDetails($id) {
        try {
            $pdo = pdo_connect_mysql();
            $stmt = $pdo->prepare("SELECT username, name, email FROM users WHERE user_id=:id");
            $stmt->bindParam("id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
}
?>