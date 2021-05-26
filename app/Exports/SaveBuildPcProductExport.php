<?php

namespace App\Exports;

use App\Models\SavebuildpcProduct;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Helper;

class SaveBuildPcProductExport implements FromView
{
    public $result;
    public $saveBuildPc;
    public function __construct($result, $saveBuildPc)
    {
        $this->result = $result;
        $this->saveBuildPc = $saveBuildPc;
    }
    public function view(): View
    {
        return view('site.export_config_excel', [
            'result' => $this->result,
            'saveBuildPc' => $this->saveBuildPc
        ]);
    }
}
