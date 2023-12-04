<?php

class Validation {
    public function validateAll ($ProfessionalClient) {
        $errors = [];

        $this->nameValidation($ProfessionalClient->getName(), $errors);
        $this->lastnameValidation($ProfessionalClient->getLastname(), $errors);
        $this->emailValidation($ProfessionalClient->getEmail(), $errors);
        $this->usernameValidation($ProfessionalClient->getUsername(), $errors);
        $this->addressValidation($ProfessionalClient->getAddress(), $errors);
        $this->businessNameValidation($ProfessionalClient->getBusinessName(), $errors);
        $this->nifValidation($ProfessionalClient->getDni(), $errors);
        $this->phoneValidation($ProfessionalClient->getPhone(), $errors);
        $this->targetNumValidation($ProfessionalClient->getTargetNum(), $errors);
        $this->cifValidation($ProfessionalClient->getCif(), $errors);
        $this->managerNifValidation($ProfessionalClient->getManagerNif(), $errors);
        $this->passwdValidation($ProfessionalClient->getPasswd(), $errors);

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


    public function addressValidation($address, &$errors) {
        if(empty($address)) {
            $errors[] = "El campo domicilio no puede estar vacio";
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

    public function nifValidation($nif, &$errors) {
        if(empty($nif)) {
            $errors[] = "El campo nif no puede estar vacio";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $nif)) {
                $errors[] = "NIF no valido";
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

    public function targetNumValidation($targetNum, &$errors) {
        if(empty($targetNum)) {
            $errors[] = "Debes proporcionar un numero";
        } else {
            if (!preg_match("/^[0-9]{16}$/", $targetNum)) {
                $errors[] = "Telefono no valido";
            }
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

    public function managerNifValidation($nif, &$errors) {
        if(empty($nif)) {
            $errors[] = "Debes proporcionar un NIF";
        } else {
            if (!preg_match("/^[0-9]{8}[A-Z]$/", $nif)) {
                $errors[] = "NIF no valido";
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

}