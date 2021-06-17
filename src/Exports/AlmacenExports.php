<?php

namespace jazmy\FormBuilder\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use jazmy\FormBuilder\Models\Form;
use jazmy\FormBuilder\Models\Submission;

class AlmacenExports implements FromCollection, WithHeadings
{

    private $id;

    public function __construct(int $id) 
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        $hs=Form::where(["id"=>$this->id])->pluck('form_builder_json')->toArray();
        $arr=json_decode($hs[0],TRUE); 
        $h1=array();
        foreach($arr as $h){ $h1[]=$h['label']; }
        return $h1;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  collect(Submission::where(['form_id' => $this->id])->pluck("content")->toArray());
    }
}
