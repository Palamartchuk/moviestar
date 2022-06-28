<?php 


    Class Message {

        private $url;

        public function __construct($url)
        {
            $this->url = $url;
        }

        public function defineMessage($msg, $type, $redirect = "index.php" ) {

            $_SESSION["msg"] = $msg;
            $_SESSION["type"] = $type;
            

            if($redirect != "back") {

                header("Location: $this->url" . $redirect);

            } else {

                header("Location: " . $_SERVER['HTTP_REFERER']); // Ultima url que o usuário entrou.
                
            }

        }

        public function pegaMessage() {

            if(!empty($_SESSION["msg"])) {
                return [
                    
                    "msg" => $_SESSION["msg"],
                    "type" => $_SESSION["type"],
                    
                ];
            } else {
                return false;
            }
        }




        public function limpaMessage() {

            $_SESSION["msg"] = "";
            $_SESSION["type"] = "";
            
        }

    }