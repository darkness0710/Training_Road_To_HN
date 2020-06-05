<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lottery extends Model
{
    protected $fillable = [
        'date','result',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public static function insertData($passingData)
    {
        $value = DB::table('lotteries')->where('date', $passingData['date'])->get();
        if ($value->count() == 0) {
            DB::table('lotteries')->insert($passingData);
        }
    }
}
