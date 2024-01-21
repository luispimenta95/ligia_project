<?php
class ConfigBd
{
    private $conn;

    function initBd(): mixed
    {
        $isLocal = true;
        if ($isLocal) {
            $this->conn = new MySQLi('localhost', 'root', '', 'portal');
        } else {
            $this->conn = new MySQLi('localhost', 'id18925220_localhost', 'Mp13151319!', 'id18925220_portal');
        }
        if ($this->conn->connect_error) {
            return false;
        }
        return $this->conn;
    }
}
