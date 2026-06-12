<?php

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function emailExists($email)
    {
        $sql = "SELECT id FROM users WHERE email = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$email]);

        return $stmt->fetch();
    }

    public function getAllUsers()
{
    $sql = "SELECT id, forename, surname, email, created_at
            FROM users
            ORDER BY id DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function deleteUser($id)
{
    $sql = "DELETE FROM users WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([$id]);
}

public function getUserById($id)
{
    $sql = "SELECT * FROM users WHERE id = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function updateUser($data)
{
    $sql = "UPDATE users
            SET forename = :forename,
                surname = :surname,
                title = :title,
                dob = :dob,
                mobile = :mobile,
                other_phone = :other_phone,
                email = :email
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':forename'    => $data['forename'],
        ':surname'     => $data['surname'],
        ':title'       => $data['title'],
        ':dob'         => $data['dob'],
        ':mobile'      => $data['mobile'],
        ':other_phone' => $data['other_phone'],
        ':email'       => $data['email'],
        ':id'          => $data['id']
    ]);
}

  public function getUserByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([$email]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
   public function register($data)
{
    $sql = "INSERT INTO users
    (
        forename,
        surname,
        title,
        dob,
        mobile,
        other_phone,
        email,
        password
    )
    VALUES
    (
        :forename,
        :surname,
        :title,
        :dob,
        :mobile,
        :other_phone,
        :email,
        :password
    )";

    $stmt = $this->conn->prepare($sql);

    $dob = !empty($data['dob']) ? $data['dob'] : null;

    return $stmt->execute([
        ':forename' => $data['forename'],
        ':surname' => $data['surname'],
        ':title' => $data['title'],
        ':dob' => $dob,
        ':mobile' => $data['mobile'],
        ':other_phone' => $data['other_phone'],
        ':email' => $data['email'],
        ':password' => password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        )
    ]);
}
}