<?php

namespace jazmy\FormBuilder\Imports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use jazmy\FormBuilder\Models\Form;
use jazmy\FormBuilder\Models\Submission;
use DB;

class AlmacenImport implements ToCollection
{

    private $id;

    public function __construct(int $id) 
    {
        $this->id = $id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {



                 DB::beginTransaction();       
                 try {
                    $hs=Form::where(["id"=>$this->id])->pluck('form_builder_json')->toArray();
                    $arr=json_decode($hs[0],TRUE); 
                    $h1=array();
                    $h2=array();

                    foreach ($collection as $row){
                            $i=0;
                        foreach($arr as $h){
                            $h1[$h['name']] = $row[$i];  
                        $i++;
                        } 
                        $input['content']    = $h1;
                        $input['form_id']    = $this->id;
                        $input['user_id ']   = 1;
                        $input['created_at'] = now();
                        $input['updated_at'] = now();
                        $datos = Submission::updateOrCreate(['content'=>json_encode($input['content'])],$input);

                    }

                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollback();
                        throw $e;
                    } catch (\Throwable $e) {
                        DB::rollback();
                        throw $e;
                    }


    }
}
