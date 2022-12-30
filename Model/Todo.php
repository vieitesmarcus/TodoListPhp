<?php
require 'Model.php';
class Todo
{
    private int $id;
    private string $text;
    private string $created_at;
    private string $updated_at;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param  string  $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }


    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        $date = new DateTime($this->created_at);
        $date = $date->format("d-m-Y H:i:s");
        return $date;
    }

    /**
     * @param  string  $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $date = new DateTime($created_at);
        $date = $date->format("d-m-Y H:i:s");
        $this->created_at = $date;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        $date = new DateTime($this->updated_at);
        $date = $date->format("d-m-Y H:i:s");
        return $date;
    }

    /**
     * @param  string  $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $date = new DateTime($updated_at);
        $date = $date->format("d-m-Y H:i:s");
        $this->updated_at = $date;
    }

    public function findAll()
    {
        $select = "SELECT * FROM list";
        /** @var PDOStatement $find */
        $find = (new Model())->read($select);
        return $find->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, __CLASS__);
    }

    public function find($id)
    {
        $select = "SELECT * FROM list";
        /** @var PDOStatement $find */
        $find = (new Model())->read($select, ["id"=>$id], " WHERE id = :id");
        $find->setFetchMode(PDO::FETCH_CLASS,__CLASS__);
        return $find->fetch();
    }
    
    
    public function insert()
    {
        $insert = "INSERT INTO list (text) VALUES (:text)";
        $obTodo =  (new Model())->create($insert, [":text"=>$this->text]);

    }

    public function update()
    {
        $update = "UPDATE list SET text = :text WHERE id = :id";
        $obTodo = (new Model())->update($update, [":text"=>$this->getText(),':id'=>$this->getId()]);

    }

    public function delete()
    {
        $delete = "DELETE FROM list WHERE id = :id";
        return (new Model())->delete($delete, $this->getId());
    }

}
