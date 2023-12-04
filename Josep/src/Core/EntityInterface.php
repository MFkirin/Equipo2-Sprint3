<?php
interface EntityInterface {

    public function getId(): int;
    public static function fromArray(array $array): EntityInterface;
    public static function toArray(EntityInterface $entity): array;

}