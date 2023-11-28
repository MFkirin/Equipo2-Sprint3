<?php

require __DIR__ . '/../Core/Repository.php';


class ProviderRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function find(int $id): EntityInterface
    {
        try {
            $pdoStatement = $this->pdo->prepare("SELECT * FROM provider WHERE id = :id");
            $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);
            $pdoStatement->bindValue(':id',$id);
            $pdoStatement->execute();
            // TODO: Implement find() method.
            // TODO: Implement FetchMode in PDO object
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

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
        $pdoStatement = $this->pdo->prepare("SELECT * FROM provider");
        $pdoStatement->execute();
        // TODO: Implement FetchMode in PDO object
        $pdoStatement->setFetchMode(PDO::FETCH_ASSOC);

        // get all records from database
        $providerRecords = $pdoStatement->fetchAll();

        $providers = [];
        // transform records into objects
        foreach ($providerRecords as $providerRecord) {
            $providers[] = call_user_func_array([$this->entityClassName, "fromArray"], [$providerRecord]);
        }

        return $providers;
    }

    /**
     * @inheritDoc
     */
    public function create(EntityInterface $entity): void
    {
        // TODO: Implement create() method.
        try {
            $pdoStatement = $this->pdo->prepare("INSERT INTO provider (email,phone,dni,cif,address,bank_title,manager_nif,LOPD_doc,constitution_article) VALUES (:email,:phone,:dni,:cif,:address,:bankTitle,:managerNIF,:LOPDdoc,:constitutionArticle)");
            $pdoStatement->bindValue(':email', $entity->getEmail());
            $pdoStatement->bindValue(':phone', $entity->getPhone());
            $pdoStatement->bindValue(':dni', $entity->getDni());
            $pdoStatement->bindValue(':cif', $entity->getCif());
            $pdoStatement->bindValue(':address', $entity->getAddress());
            $pdoStatement->bindValue(':bankTitle', $entity->getBankTitle());
            $pdoStatement->bindValue(':managerNIF', $entity->getManagerNIF());
            $pdoStatement->bindValue(':LOPDdoc', $entity->getLOPDdoc());
            $pdoStatement->bindValue(':constitutionArticle', $entity->getConstitutionArticle());
            $ok = $pdoStatement->execute();
            if (!$ok)
                throw new Exception("No s'ha pogut executar al consulta");
        } catch (Exception $e) {
            throw new Exception("Error");
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(EntityInterface $entity): void
    {
        // TODO: Implement delete() method.
        try {
            $pdoStatement = $this->pdo->prepare("DELETE FROM provider WHERE id = :id");
            $pdoStatement->bindValue(':id', $entity->getId());
            $ok = $pdoStatement->execute();
            if (!$ok)
                throw new Exception("No s'ha pogut executar al consulta");
        } catch (Exception $e) {
            throw new Exception("Error");
        }
    }

    /**
     * @inheritDoc
     */
    public function update(EntityInterface $entity): void
    {
        // TODO: Implement update() method.
        try {
            $pdoStatement = $this->pdo->prepare("UPDATE provider SET email = :email, phone = :phone, dni = :dni, cif = :cif, address = :address, bank_title = :bankTitle, manager_nif = :managerNIF, LOPD_doc = :LOPDdoc, constitution_article = :constitutionArticle WHERE id = :id");
            $pdoStatement->bindValue(':email', $entity->getEmail());
            $pdoStatement->bindValue(':phone', $entity->getPhone());
            $pdoStatement->bindValue(':dni', $entity->getDni());
            $pdoStatement->bindValue(':cif', $entity->getCif());
            $pdoStatement->bindValue(':address', $entity->getAddress());
            $pdoStatement->bindValue(':bankTitle', $entity->getBankTitle());
            $pdoStatement->bindValue(':managerNIF', $entity->getManagerNIF());
            $pdoStatement->bindValue(':LOPDdoc', $entity->getLOPDdoc());
            $pdoStatement->bindValue(':constitutionArticle', $entity->getConstitutionArticle());
            $pdoStatement->bindValue(':id', $entity->getId());

            $ok = $pdoStatement->execute();
            if (!$ok)
                throw new Exception("No s'ha pogut executar al consulta");
        } catch (Exception $e) {
            throw new Exception("Error");
        }
    }
}