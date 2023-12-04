<?php

class ProfessionalValidation {
    public function validateAll($professionalClient) {
        $errors = [];

        $this->nameValidation($professionalClient->getName(), $errors);
        $this->lastnameValidation($professionalClient->getLastname(), $errors);
        $this->emailValidation($professionalClient->getEmail(), $errors);
        $this->usernameValidation($professionalClient->getUsername(), $errors);
        $this->nifValidation($professionalClient->getNif(), $errors);
        $this->businessNameValidation($professionalClient->getBusinessName(), $errors);
        $this->phoneValidation($professionalClient->getPhone(), $errors);
        $this->addressValidation($professionalClient->getAddress(), $errors);
        $this->cifValidation($professionalClient->getCif(), $errors);
        $this->passwdValidation($professionalClient->getPasswd(), $errors);
        $this->rpasswdValidation($professionalClient->getPasswd(), $professionalClient->getRPasswd(), $errors);

        return $errors;
    }

    public function nameValidation($name, &$errors) {
        if (empty($name)) {
            $errors[] = "El campo nombre no puede estar vacío";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $name)) {
                $errors[] = "Nombre no válido";
            }
        }
    }

    public function lastnameValidation($lastName, &$errors) {
        if (empty($lastName)) {
            $errors[] = "El campo apellido no puede estar vacío";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $lastName)) {
                $errors[] = "Apellido no válido";
            }
        }
    }

    public function emailValidation($email, &$errors) {
        if(empty($email)) {
            $errors[] = "El campo correo no puede estar vacio";
        } else {
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
                $errors[] = "Correo no valido";
            }
        }
    }

    public function usernameValidation($username, &$errors) {
        if (empty($username)) {
            $errors[] = "El nombre de usuario no puede estar vacío";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $username)) {
                $errors[] = "Nombre de usuario no válido";
            }
        }
    }

    public function nifValidation($nif, &$errors) {
        if(empty($nif)) {
            $errors[] = "El campo nif no puede estar vacio";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $nif)) {
                $errors[] = "NIF no valido";
            }
        }
    }

    public function businessNameValidation($businessName, &$errors) {
        if(empty($businessName)) {
            $errors[] = "Debes proporcionar un nombre de empresa";
        } else {
            if (!preg_match("/^[A-Za-z\s]+$/", $businessName)) {
                $errors[] = "Nombre de la empresa no valido";
            }
        }
    }

    public function phoneValidation($phone, &$errors) {
        if(empty($phone)) {
            $errors[] = "El campo telefono no puede estar vacio";
        } else {
            if (!preg_match("/^[0-9]{9}$/", $phone)) {
                $errors[] = "Telefono no valido";
            }
        }
    }

    public function addressValidation($address, &$errors) {
        if(empty($address)) {
            $errors[] = "El campo domicilio no puede estar vacio";
        }
    }

    public function cifValidation($cif, &$errors) {
        if(empty($cif)) {
            $errors[] = "El campo cif no puede estar vacio";
        } else {
            if (!preg_match("/^[A-Za-z]+[0-9]{9}$/", $cif)) {
                $errors[] = "CIF no valido";
            }
        }
    }

    public function passwdValidation($passwd, &$errors) {
        if(empty($passwd)) {
            $errors[] = "Debes establecer una contraseña";
        } else {
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $passwd)) {
                $errors[] = "Contraseña no valida";
            }
        }
    }

    public function rpasswdValidation($passwd, $rpasswd, &$errors) {
        if (empty($rpasswd)) {
            $errors[] = "Vuelve a introducir la contraseña";
        } else {
            if ($passwd !== $rpasswd) {
                $errors[] = "Las contraseñas no coinciden";
            }
        }
    }
}