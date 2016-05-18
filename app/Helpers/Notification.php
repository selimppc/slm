<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/18/16
 * Time: 4:20 PM
 */

namespace App\Helpers;

use App\Modules\Slm\Models\Safety;
use App\Modules\Slm\Models\CabinCrew;
use App\Modules\Slm\Models\ConfidentSafety;
use App\Modules\Slm\Models\GroundHandling;
use App\Modules\Slm\Models\MaintenanceOccurrence;
use App\Modules\Slm\Models\OperationalSafety;


class Notification
{
    public static function notify_data() {

        $notify_count = 0;

        $safety_data = Safety::where('notified_no', 0)->get();
        $safety_count = count($safety_data);
        if($safety_count>0){$notify_count = $notify_count +1;}

        $cabin_data = CabinCrew::where('notified_no', 0)->get();
        $cabin_count = count($cabin_data);
        if($cabin_count>0){$notify_count = $notify_count +1;}

        $confident_data = ConfidentSafety::where('notified_no', 0)->get();
        $confident_count = count($confident_data);
        if($confident_count>0){$notify_count = $notify_count +1;}

        $ground_data = GroundHandling::where('notified_no', 0)->get();
        $ground_count = count($ground_data);
        if($ground_count>0){$notify_count = $notify_count +1;}

        $maintenance_data = MaintenanceOccurrence::where('notified_no', 0)->get();
        $maintenance_count = count($maintenance_data);
        if($maintenance_count>0){$notify_count = $notify_count +1;}

        $operation_data = OperationalSafety::where('notified_no', 0)->get();
        $operation_count = count($operation_data);
        if($operation_count>0){$notify_count = $notify_count +1;}

        $input_notify = [
            'safety'        => $safety_count,
            'cabin'         => $cabin_count,
            'confident'     => $confident_count,
            'ground'        => $ground_count,
            'maintenance'   => $maintenance_count,
            'operation'     => $operation_count,
            'notify_count'     => $notify_count
        ];




        return $input_notify;
    }
}