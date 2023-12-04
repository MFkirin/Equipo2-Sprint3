<?php

require_once __DIR__. '/../Core/Repository.php';

class ProviderRepository extends Repository {

    public function find(int $id): EntityInterface {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM provider WHERE id = :id");
            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
            $pdoStatement->bindValue(':id',$id);
            $pdoStatement->execute();

            $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
            if($row){
                $provider = Provider::fromArray($row);
                return $provider;
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
        throw new Exception("Provider not found");
    }

    public function findAll(): array {
        $pdoStatement = $this->pdo->prepare("SELECT * FROM provider");
        $pdoStatement->execute();
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        $providerRecords = $pdoStatement->fetchAll();

        $providers = [];
        foreach ($providerRecords as $providerRecord) {
            $providers[] = call_user_func_array([$this->entityClassName, "fromArray"], [$providerRecord]);
        }

        return $providers;
    }

    public function create(EntityInterface $entity): void {

    }

    public function delete(EntityInterface $entity): void {

    }

    public function update(EntityInterface $entity): void {

    }
}