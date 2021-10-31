<?php
class Rwanda extends DatabaseObject
{
    static protected $db_columns = ["id", "Name"];
    public $id;
    public $Name;
    static public function find_province()
    {
        $sql = "SELECT * FROM Rw_province ";
        $sql .= " where active=1;";
        return static::find_by_sql($sql);
    }

    static public function find_district_by_procinve($province_id)
    {
        $sql = "SELECT * FROM Rw_district ";
        $sql .= " where province_id='" . self::$db->escape_string($province_id) . "' ";
        $sql .= " and active=1;";
        return static::find_by_sql($sql);
    }
    static public function find_sector_by_district($district)
    {
        $sql = "SELECT * FROM Rw_sector ";
        $sql .= " where district_id='" . self::$db->escape_string($district) . "' ";
        $sql .= " and active=1;";
        return static::find_by_sql($sql);
    }
}