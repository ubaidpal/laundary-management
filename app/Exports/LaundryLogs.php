<?php
namespace App\Exports;

use App\Models\LaundryLog;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaundryLogs implements FromQuery, WithHeadings, WithMapping
{

    public function query()
    {
        $logs =  LaundryLog::first();
        // $logs->username = $logs['user']->username;
        // dd($logs);
        return $logs;
    }

    public function headings(): array
    {
        return ["Date", "User Name", "Weight Received","Weight Plan","Overweight","OverCharge","Drycleaning","Total Amount"];
    }

    public function map($logs): array
    {

        return [
            $logs->date,
            $logs->username,
            $logs->weight_received,
            $logs->weight_plan,
            $logs->overweight,
            $logs->overcharged,
            $logs->drycleaning,
            $logs->total,
        ];
    }

}
