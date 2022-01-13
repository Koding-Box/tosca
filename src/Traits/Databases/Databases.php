<?php

namespace Kodingbox\Tosca\Traits\Databases;

use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

trait Databases
{
    protected $db_connection;

    /**
     *
     *
     * @param string $connection
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function connection(string $connection = 'default')
    {
        $connection = $connection == 'default' ? (!is_null($this->db_connection) ? $this->db_connection : config('database.default')) : $connection;

        return DB::connection($connection);
    }

    /**
     * update table
     *
     * @param string $table
     * @param array|null $where
     * @param array $update_data
     */
    public function update_table(string $table = '', array $where = null, mixed $update_data = null)
    {
        return $this->connection()->table($table)
            ->where($where)
            ->update($update_data);
    }

    /**
     * insert to table
     *
     * @param string $table
     * @param array $insert_data
     * @return bool
     */
    public function insert_table(string $table = '', mixed $insert_data = null)
    {
        return $this->connection()->table($table)->insert($insert_data);
    }

    /**
     * insert data and return id
     *
     * @param string $table
     * @param array $insert_data
     * @return int
     */
    public function insert_table_get_id(string $table = '', array $insert_data = null)
    {
        return $this->connection()->table($table)->insertGetId($insert_data);
    }

    /**
     * delete data table
     *
     * @param string $table
     * @param mixed|null $where
     * @return int
     */
    public function delete_table(string $table = '', mixed $where = null)
    {
        return $this->connection()->table($table)->where($where)->delete();
    }

}
