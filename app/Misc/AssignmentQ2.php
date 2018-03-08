<?php

namespace App\Misc;

use App\Booking;

class AssignmentQ2 {

    /*
     * $uniquePassengerThreshold    to filter out data driver with(or more than) the number of unique passenger has completed rides(inclusive)
     * $minCompletedRides           to filter out data driver with(or less than) the completed rides(inclusive)
     **/
    public static function extractBookingData($uniquePassengerThreshold = 5, $minCompletedRides = 10)
    {
        
        $rate = Booking::$commissionRate;

        $result = Booking::select(
            'bookings.driver_id',
            \DB::raw("COUNT(*) filter (WHERE state = '".Booking::RIDE_COMPLETED."') as number_of_completed_rides"),
            \DB::raw("COUNT(*) filter (WHERE state <> '".Booking::RIDE_COMPLETED."' ) as number_of_cancelled_rides"),
            \DB::raw("COUNT(distinct passenger_id) filter (WHERE state = '". Booking::RIDE_COMPLETED."') as number_of_unique_passengers"),
            \DB::raw("SUM(fare) filter (WHERE state = '".Booking::RIDE_COMPLETED."') as total_fare"),
            \DB::raw("ROUND(SUM(fare) filter (WHERE state = '".Booking::RIDE_COMPLETED."') * $rate, 2) as total_commission")
        )
        ->join('drivers', 'drivers.driver_id', '=', 'bookings.driver_id')
        ->where('drivers.email', 'SIMILAR TO', '%fv(drive|taxi)%')
        ->groupBy('bookings.driver_id')
        ->havingRaw("COUNT(*) filter (WHERE state = '".Booking::RIDE_COMPLETED."') > $minCompletedRides AND COUNT(distinct passenger_id) filter (WHERE state = '".Booking::RIDE_COMPLETED."') < $uniquePassengerThreshold")
        ->orderBy('bookings.driver_id')
        ->get()
        ->toArray();

        return $result;
    }
}
