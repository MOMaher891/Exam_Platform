<?php

namespace App\Imports;

use App\Models\Center;
use App\Models\Time;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CenterImport implements ToModel , WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /**
    * start from secound 
    */
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        // try{

            $user_id = User::where('code',$row[0])->first();
            // $dataTime =  Time::all()->pluck('id');
            // $times = [];
            // check if there is
            // time 1 
            // if($row[4] == 1)
            // {
            //     array_push($times,$dataTime[0]);
            // } 
            // // time 2
            // if($row[5] == 1)
            // {
            //     array_push($times,$dataTime[1]);

            // }
            // // time 3  
            // if($row[6] == 1)
            // {
            //     array_push($times,$dataTime[2]);

            // }
            // // time 4  
            // if($row[7] == 1)
            // {
            //     array_push($times,$dataTime[3]);

            // }
            // $times = implode(',',$times);


            // // Num of Observes
            // $dataNum  =[];
            // if($row[8] != 0)
            // {
            //     array_push($dataNum,$row[8]);
            // } 
            // // time 2
            // if($row[9] != 0)
            // {
            //     array_push($dataNum,$row[9]);
            // }
            // // time 3  
            // if($row[10] != 0)
            // {
            //     array_push($dataNum,$row[10]);

            // }
            // // time 4  
            // if($row[11] != 0)
            // {
            //     array_push($dataNum,$row[11]);
            // }
           
            // $numOfObserve = implode(',',$dataNum);
            
        // }catch(Exception $e)
        // {
        //     return $e;
        // }


        DB::beginTransaction();
        // try{
            $center =  Center::create([
                'user_id'=>$user_id->id,
                'name'=> $row[1],
                'phone'=>$row[2],
                'address'=>$row[3],
            ]);

            DB::commit();
        // }catch(Exception $e)
        // {
            // DB::rollBack();
            // return $e;
        // }

        
    }

}
