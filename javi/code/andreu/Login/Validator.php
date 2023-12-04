<?php
class Validator {
    private string $email;
    private string $password;
    private array $errors = [];

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function validate(): bool {
        try {
            $this->validateEmail();
            $this->validatePassword();
            return empty($this->errors);
        } catch (Exception $e) {
            error_log('Error durante la validación: ' . $e->getMessage());
            return false;
        }
    }

    public function validateEmail(): void {
        if (empty($this->email)) {
            $this->errors[] = "El correo electrónico no puede estar vacío.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "El formato del correo electrónico no es válido.";
        } elseif (strlen($this->email) > 20) {
            $this->errors[] = "El correo electrónico no puede tener más de 20 caracteres.";
        } elseif (preg_match('/[áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜ]/', $this->email)) {
            $this->errors[] = "El correo electrónico no puede contener acentos.";
        }
    }

    public function validatePassword(): void {
        if (empty($this->password)) {
            $this->errors[] = "La contraseña no puede estar vacía.";
        } elseif (strlen($this->password) < 8) {
            $this->errors[] = "La contraseña debe tener al menos 8 caracteres.";
        }

        // La contraseña debe contener 1 número (0-9).
        // La contraseña debe contener 1 letra mayúscula.
        // La contraseña debe contener 1 letra minúscula.
        // La contraseña debe contener 1 número no alfanumérico.
        // La contraseña tiene entre 8 y 16 caracteres sin espacios.
        elseif (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\s:])(\S){8,16}$/m', $this->password)) {
            $this->errors[] = "La contraseña solo puede contener letras, números y los símbolos -._";
        }
    }

    public function getErrors(): array {
        return $this->errors;
    }
}
