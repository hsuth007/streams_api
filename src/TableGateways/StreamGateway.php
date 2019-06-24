<?php
namespace Src\TableGateways;

class streamGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function searchAllStreams()
    {
        $statement = "
            SELECT 
                id, streamUrl, captions, ads
            FROM
                stream;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function searchByStreamId($id)
    {
        $statement = "
            SELECT 
                id, streamUrl, captions, ads
            FROM
                stream
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
