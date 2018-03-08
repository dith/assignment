<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class BookingSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'bookings';
        $this->filename = base_path() . '/database/seeds/csv/bookings.csv';
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
