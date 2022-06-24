<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
    use HasFactory;
    protected $table = 'interested';
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function cake()
    {
        return $this->belongsToMany(Cake::class)->withTimestamps();
    }

    public static function store_interested($request,$cake_id)
    {
        foreach ($request->interested as $mail) {
            if ($mail) {
                $new_client = Interested::create([
                    'mail' => $mail,
                ]);
                $new_client->cake()->attach($cake_id);
            }
        }
    }
}
