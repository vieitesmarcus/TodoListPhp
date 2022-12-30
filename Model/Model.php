<?php
require "Conexao.php";

class Model extends Conexao
{
    public function create(string $create, $params = []): ?bool
    {
        try {
            $stmt = parent::getInstance()->prepare($create);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    return null;
    }

    public function read(string $select, $params = [], string $where="")
    {
        try {
            $stmt = $this->getInstance()->prepare($select.$where);
            $stmt->execute($params);
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }

    public function update(string $update, $params=[])
    {
        try {
            $stmt = $this->getInstance()->prepare($update);
            $stmt->execute($params);
            var_dump($stmt);
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }

    public function delete($delete, $id)
    {
        try{
            $stmt = $this->getInstance()->prepare($delete);

            return $stmt->execute([":id"=>$id]);
        }catch(PDOException $e){
            $e->getMessage();
        }
    }
}