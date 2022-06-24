<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;
    protected $table = 'cake';
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function interested()
    {
        return $this->belongsToMany(Interested::class);
    }

    public static function list_cakes()
    {
        return Cake::with('interested:id,mail')->get();
    }
    public static function list_specific_cake($id)
    {
        return Cake::with('interested:id,mail')->find($id);
    }
    public static function store_cake($request)
    {
        return $new_cake = Cake::create([
            'name' => $request->name,
            'weight_in_grams' => $request->weight,
            'value' => $request->value,
            'remaining' =>$request->remaining,
        ]);
    }

    public static function update_cake($request,$id)
    {
        $cake = Cake::findOrFail($id);
        return $cake ->update([
            'name' => $request->name,
            'weight_in_grams' => $request->weight,
            'value' => $request->value,
            'remaining' =>$request->remaining,
        ]);
    }

    public static function delete_cake($id){
        $cake = Cake::findOrFail($id);
        $cake->interested()->detach();
        $cake->delete();
    }
}
