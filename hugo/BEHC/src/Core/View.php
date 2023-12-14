<?php

class View
{
    static public function render(string $view, string $layout = 'default', array $data = []): string {

        extract($data);

        ob_start();
        require __DIR__ . "/../../views/{$view}.view.php";
        $content = ob_get_clean();


        ob_start();
        require __DIR__ . "/../../views/layouts/{$layout}.layout.php";
        // Retorna el contingut del buffer i desactiva el buffering
        $content = ob_get_clean();

        return $content;
    }
}