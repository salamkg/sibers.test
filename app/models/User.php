<?php

namespace app\models;

use app\core\Model;

class User extends Model{

    public string $email;
    public string $password;
    public string $first_name;
    public string $last_name;
    public string $gender;
    public string $birthday;


    public function register($post)
    {
        $params = [
            'id' => $this->db->lastId(),
            'email' => $post['email'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'first_name' => $post['first_name'],
            'last_name' => $post['last_name'],
            'gender' => $post['gender'],
            'birthday' => $post['birthday']
        ];

        $sql = 'INSERT INTO users VALUES (:id, :email, :password, :first_name, :last_name, :gender, :birthday)';

        $this->db->query($sql, $params);
    }

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class,
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 24]],
            'first_name' => [self::RULE_REQUIRED],
            'last_name' => [self::RULE_REQUIRED],
        ];
    }

}