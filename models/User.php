<?php 

    class User {

        public $id;
        public $name;
        public $lastname;
        public $email;
        public $password;
        public $image;
        public $bio;
        public $token;


        //Gera o token 
        public function generateToken() {
            
            return bin2hex(random_bytes(50));
        }

        // Gera o password
        public function generatePassword($password) {

            return password_hash($password, PASSWORD_DEFAULT);
        }

        //Retorna nome completo

        public function getFullName($user) {
            return $user->name . " " . $user->lastname;
        }


        public function imageGenerateName() {
            return bin2hex(random_bytes(60)) . ".jpg";
        }

    }

    interface UserInterface {

        public function buildUser($data);
        public function create(User $user, $authUser = false);
        public function update(User $user, $redirect = true);
        public function verifyToken($protected = false);
        public function setTokenToSession($token, $redirect = true);
        public function authenticateUser($email, $password);
        public function findByToken($token);
        public function findByEmail($email);
        public function findById($id);
        public function changePassword(User $user);
        public function destroyToken();
    }