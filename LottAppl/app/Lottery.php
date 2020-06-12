<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Lottery extends Model
{
    protected $fillable = [
        'date', 'result',
    ];

    protected $casts = [
        'result' => 'array',
    ];

    public static function insertData($passingData)
    {
        $value = DB::table('lotteries')->where('date', $passingData['date'])->get();
        if ($value->count() == 0) {
            DB::table('lotteries')->insert($passingData);
        }
    }

    // public function setDateAttribute($value)
    // {
    //     $this->attributes['date'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    // }

    // public function getDateAttribute($value)
    // {
    //     //return Carbon::parse($value)->format('d-m-Y');
    //     return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    // }
}
