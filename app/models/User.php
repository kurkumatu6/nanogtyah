<?
namespace app\models;
use app\base\PDOConnection;

class User{
    private static function connect($config = CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }
    //метод, который ищет пользователя для авторизации
    public static function getUser($email, $password)
    {
        $query = self::connect()->prepare("SELECT * FROM user WHERE user.email = :email");
        $query->execute([":email" => $email]);
        $user = $query->fetch();
        if (password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }
    //метод, который ищет логин,нужен для авторизации(проверка пароля)
    public static function findEmail($email)
    {
        $query = self::connect()->prepare("SELECT * FROM user WHERE user.email = ?");
        $query->execute([$email]);
        $user =  $query->fetchAll();
        return !empty($user); //возращает true, если какие то пользователи есть
    }
    public static function allRole()
    {
        $query = self::connect()->query("SELECT role FROM user");
        $query->fetchAll();
    }
    //регистрируем пользователя
    public static function insert($data)
    {
        $query = self::connect()->prepare("INSERT INTO user (surname, name, email, phone, password, role) VALUES (:surname, :name, :email, :phone, :password, :role)");
        return $query->execute([
            ':surname' => $data["surname"],
            ':name' => $data["name"],
            ':email' => $data["email"],
            ':phone' => $data["phone"],
            ':password' => password_hash($data["password"], PASSWORD_DEFAULT),
            ':role' => 'клиент'
        ]);
    }
    //ищем пользователя по айдишнику
    public static function findId($id)
    {
        $query = self::connect()->prepare("SELECT * FROM user WHERE user.id = :id");
        $query->execute([
            ':id' => $id
        ]);
        $user = $query->fetch();
        return $user;
    }
}