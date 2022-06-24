<?php

namespace App\Http\Controllers;

use App\Http\Resources\CakeResource;
use Illuminate\Http\Request;
use App\Models\Cake;
use App\Models\Interested;
use App\Http\Requests\StoreCake;
use App\Http\Requests\UpdateCake;
use Whoops\Run;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CakeResource(Cake::list_cakes());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCake $request)
    {
        try{
            $new_cake = Cake::store_cake($request);
            Interested::store_interested($request,$new_cake->id);
            $this->send_mail($request->interested,$request->remainning);
            return new CakeResource(Cake::list_specific_cake($new_cake->id));
        }
        catch(\Exception $e){
            return response()->json("error ". $e->getMessage(),422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CakeResource(Cake::list_specific_cake($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCake $request, $id)
    {
        try{
            new CakeResource(Cake::update_cake($request,$id));
            return response()->json("success",200);
        }
        catch(\Exception $e){
            return response()->json("error ". $e->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            new CakeResource(Cake::delete_cake($id));
            return response()->json("success",200);
        }
        catch(\Exception $e){
            return response()->json("error ". $e->getMessage(),422);
        }
    }

    public function send_mail($mail_list,$cakes_remainning){

        //Pega uma quantidade de emails proporcional ao numero de bolos restantes
        $sliced_array = array_slice($mail_list, 0, 5);
        $mail_obj = new MailSender();
        $mail_obj->send_bulkmail($sliced_array);
    }
}
