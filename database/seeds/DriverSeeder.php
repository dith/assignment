<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class DriverSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'drivers';
        $this->filename = base_path() . '/database/seeds/csv/drivers.csv';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }
}
