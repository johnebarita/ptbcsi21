<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Eloquent\SSSLookup;


class SsscontributionController extends BaseController
{
    public function index()
    {
        $data['sss_lookup'] = SSSLookup::orderBy('from')->get();
        return $this->blade->run('deduction.sss-contribution.sss_contribution_table', $data);
    }

    public function create()
    {
        $lookup = SSSLookup::updateOrCreate(
            [
                'from'=>$_POST['from'],
                'to'=>$_POST['to'],
                'salary_credit'=>$_POST['salary_credit'],
                'ss_er'=>$_POST['ss_er'],
                'ss_ee'=>$_POST['ss_ee'],
                'ss_total'=>$_POST['ss_total'],
                'ec_er'=>$_POST['ec_er'],
                'tc_er'=>$_POST['tc_er'],
                'tc_ee'=>$_POST['tc_ee'],
                'tc_total'=>$_POST['tc_total'],
            ],
            [
                'from'=>$_POST['from'],
                'to'=>$_POST['to'],
                'salary_credit'=>$_POST['salary_credit'],
                'ss_er'=>$_POST['ss_er'],
                'ss_ee'=>$_POST['ss_ee'],
                'ss_total'=>$_POST['ss_total'],
                'ec_er'=>$_POST['ec_er'],
                'tc_er'=>$_POST['tc_er'],
                'tc_ee'=>$_POST['tc_ee'],
                'tc_total'=>$_POST['tc_total'],
            ]
        );

        $key = ($lookup->wasRecentlyCreated ? "success" : "danger");
        $message = ($lookup->wasRecentlyCreated ? "SSS Lookup added successfully!" : "SSS Lookup already exist!");
        return redirect()->route('sss-contribution-table.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $sss = SSSLookup::find($_POST['id']);
        $sss->from = $_POST['from'];
        $sss->to = $_POST['to'];
        $sss->salary_credit = $_POST['salary_credit'];
        $sss->ss_er = $_POST['ss_er'];
        $sss->ss_ee = $_POST['ss_ee'];
        $sss->ss_total = $_POST['ss_total'];
        $sss->ec_er = $_POST['ec_er'];
        $sss->tc_er = $_POST['tc_er'];
        $sss->tc_ee = $_POST['tc_ee'];
        $sss->tc_total = $_POST['tc_total'];
        $status = $sss->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "SSS Lookup row updated!" : "Opps! There is an error while updating the lookup row.");
        return redirect()->route('sss-contribution-table.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete()
    {
        $lookup = SSSLookup::find($_POST['id']);
        $status = $lookup->delete();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "SSS Lookup deleted successfully!" : "Opps! There is an error while deleting the sss lookup.");
        return redirect()->route('sss-contribution-table.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}
