<?php


namespace App\Controllers;


use App\Models\Eloquent\TaxDeduction;

class PagibigContributionController extends BaseController
{
    public function index(){
        $data['pag_ibig_lookups'] = TaxDeduction::where('type','pag-ibig')->get();
        return $this->blade->run('deduction.pag-ibig-contribution.pag_ibig_contribution_table',$data);
    }
}