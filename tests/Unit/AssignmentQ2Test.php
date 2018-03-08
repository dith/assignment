<?php

namespace Tests\Unit;

use Tests\TestCase;
use DriverSeeder;
use BookingSeeder;
use App\Misc\AssignmentQ2;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssignmentQ2Test extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        with(new DriverSeeder)->run();
        with(new BookingSeeder)->run();
    } 
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExtractBookingData()
    {
        $expected = [
            0 => [
                'driver_id' => 21,
                'number_of_completed_rides' => 12,
                'number_of_cancelled_rides' => 2,
                'number_of_unique_passengers' => 4,
                'total_fare' => '2941.32',
                'total_commission' => '588.26',
            ],
            1 => [
                'driver_id' => 26,
                'number_of_completed_rides' => 13,
                'number_of_cancelled_rides' => 4,
                'number_of_unique_passengers' => 4,
                'total_fare' => '2274.90',
                'total_commission' => '454.98',
            ],
            2 => [
                'driver_id' => 50,
                'number_of_completed_rides' => 11,
                'number_of_cancelled_rides' => 2,
                'number_of_unique_passengers' => 3,
                'total_fare' => '1886.99',
                'total_commission' => '377.40',
            ]
        ];

        $uniquePassengerThreshold = 5;
        $minCompletedRides = 10;

        $result = AssignmentQ2::extractBookingData($uniquePassengerThreshold, $minCompletedRides);
        
        $this->assertEquals($expected, $result, "Extracting booking data with Unique Passenger Threshold: $uniquePassengerThreshold, Minimum Completed Rides: $minCompletedRides");
    }

    public function tearDown()
    {
        /* reset sequence for postgresql after rollback */
        \DB::select('ALTER SEQUENCE drivers_driver_id_seq RESTART WITH 1');
        \DB::select('ALTER SEQUENCE bookings_booking_id_seq RESTART WITH 1');
        parent::tearDown();
    }

}
