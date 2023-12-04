<?php

require_once __DIR__. "/../Core/ValidatorInterface.php";

$roles = require_once __DIR__. "/../../config/config.php";

class VehicleValidator implements \ValidatorInterface {

    public function validate(EntityInterface $entity): array {

    }
}