<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, full_name, email, password, role) VALUES (:username, :full_name, :email, :password, :role)');

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind(':role', $data['role']);

        return $this->db->execute();
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        return false;
    }

    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        return $row ? true : false;
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users ORDER BY role, username');
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET username = :username, full_name = :full_name, email = :email, role = :role WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':full_name', $data['full_name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);

        return $this->db->execute();
    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function changePassword($userId, $newPassword)
    {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    public function getAllTeachers()
    {
        $this->db->query('SELECT * FROM users WHERE role = "guru" ORDER BY username');
        return $this->db->resultSet();
    }

    public function getTotalTeachers()
    {
        $this->db->query('SELECT COUNT(*) as total FROM users WHERE role = "guru"');
        $result = $this->db->single();
        return $result->total;
    }
}
