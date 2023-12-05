<?php
class Validator {
private string $name;
private string $lastname;
private string $businessName;
private string $domicilio;
private string $email;
private string $phone;
private string $nif;
private string $cif;
private string $passwd;
private string $rpasswd;
private array $errors;

    public function __construct(string $name, string $lastname, string $businessName, string $domicilio, string $email, string $phone, string $nif, string $cif, string $passwd, string $rpasswd) {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->businessName = $businessName;
        $this->domicilio = $domicilio;
        $this->email = $email;
        $this->phone = $phone;
        $this->nif = $nif;
        $this->cif = $cif;
        $this->passwd = $passwd;
        $this->rpasswd = $rpasswd;
    }

    public function validate() : bool {
        $this->nameValidation();
        $this->lastnameValidation();
        $this->businessNameValidation();
        $this->domicilioValidation();
        $this->emailValidation();
        $this->phoneValidation();
        $this->nifValidation();
        $this->cifValidation();
        $this->passwdValidation();
        $this->rpasswdValidation();
        return empty($this->errors);
    }

    public function nameValidation() {
        if(empty($this->name)) {
            $this->errors[] = "El campo nombre no puede estar vacio";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $this->name)) {
                $this->errors[] = "Nombre no valido";
            }
        }
    }

    public function lastnameValidation() {
        if(empty($this->lastname)) {
            $this->errors[] = "El campo apellido no puede estar vacio";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $this->lastname)) {
                $this->errors[] = "Apellido no valido";
            }
        }
    }

    public function businessNameValidation() {
        if(empty($this->businessName)) {
            $this->errors[] = "Debes proporcionar un nombre de empresa";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $this->businessName)) {
                $this->errors[] = "Nombre de la empresa no valido";
            }
        }
    }


    public function domicilioValidation() {
        if(empty($this->domicilio)) {
            $this->errors[] = "El campo domicilio no puede estar vacio";
        }
    }

    public function emailValidation() {
        if(empty($this->email)) {
            $this->errors[] = "El campo correo no puede estar vacio";
        } else {
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $this->email)) {
                $this->errors[] = "Correo no valido";
            }
        }
    }

    public function phoneValidation() {
        if(empty($this->phone)) {
            $this->errors[] = "El campo telefono no puede estar vacio";
        } else {
            if (!preg_match("/^[0-9]{9}$/", $this->phone)) {
                $this->errors[] = "Telefono no valido";
            }
        }
    }

    public function nifValidation() {
        if(empty($this->nif)) {
            $this->errors[] = "El campo nif no puede estar vacio";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $this->nif)) {
                $this->errors[] = "NIF no valido";
            }
        }
    }

    public function cifValidation() {
        if(empty($this->cif)) {
            $this->errors[] = "El campo cif no puede estar vacio";
        } else {
            if (!preg_match("/^[A-Za-z]+[0-9]{9}$/", $this->cif)) {
                $this->errors[] = "CIF no valido";
            }
        }
    }

    public function passwdValidation() {
        if(empty($this->passwd)) {
            $this->errors[] = "Debes establecer una contraseña";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $this->passwd)) {
                $this->errors[] = "Contraseña no valida";
            }
        }
    }

    public function rpasswdValidation() {
        if(empty($this->rpasswd)) {
            $this->errors[] = "Vuelve a introducir la contraseña";
        } else {
            if ($this->passwd !== $this->rpasswd) {
                $this->errors[] = "Las contraseñas no coinciden";
            }
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }
}