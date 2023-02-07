<?php

Class Post
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare('SELECT id, content FROM post ORDER BY create_date DESC');
        $stmt->execute();
        $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $posts;
    }

    public function getById($id)
    {
        $id = $_GET['id'];
        $stmt = $this->db->prepare('SELECT * FROM post WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($content)
    {
        $stmt = $this->db->prepare('INSERT INTO post (content, create_date) VALUES (:content, now())');
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update($content, $id)
    {
        $sql = "UPDATE post SET content = :content WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM post WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}