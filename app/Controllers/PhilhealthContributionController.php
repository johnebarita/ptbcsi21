<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Eloquent\TaxDeduction;

class PhilhealthContributionController extends BaseController
{
	public function index()
	{
        $data['philhealth_lookups'] = TaxDeduction::where('type','philhealth')->get();
        return $this->blade->run('deduction.phil-health-contribution.phil_health_contribution_table',$data);
	}
}
