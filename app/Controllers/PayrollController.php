<?php


namespace App\Controllers;


use App\Models\Eloquent\CashAdvance;
use App\Models\Eloquent\CashAdvanceDetail;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Holiday;
use App\Models\Eloquent\Holidays;
use App\Models\Eloquent\Leave;
use App\Models\Eloquent\Payroll;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\SSSLookup;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class PayrollController extends BaseController
{
    public function index()
    {

        $data['view'] = 'payroll\index';
        $half = (isset($_POST['half']) ? $_POST['half'] : (Carbon::now()->format('d') < 15 ? 'A' : 'B'));
        $month = (isset($_POST['month']) ? $_POST['month'] : Carbon::now()->format('m'));
        $year = (isset($_POST['year']) ? $_POST['year'] : Carbon::now()->format('Y'));
        $start = ($half == "A" ? 1 : 16);
        $end = ($half == "A" ? 15 : Carbon::createFromFormat('m-Y', $month . '-2020')->endOfMonth()->format('d'));
        $data['half'] = $half;
        $data['month'] = $month;
        $data['year'] = $year;
        $data['start'] = $start;
        $data['end'] = $end;

        $s = $year . '-' . $month . '-' . $start;
        $e = $year . '-' . $month . '-' . $end;

        if (count(Payroll::where(['from' => $s, 'to' => $e])->get()) == 0 || !Carbon::now()->gt(Carbon::parse($e))) {
            $this->calculate_payroll($s, $e, $half);
        }

        $positions = Position::with(['employees' => function ($query) use ($s, $e) {
            $query->with(['payrolls' => function ($q2) use ($s, $e) {
                $q2->where(['from' => $s, 'to' => $e]);
            }]);
        }])->orderBy('position')->get();


        $data['positions'] = $positions;
        $data['test'] = 'test';
//        return view('template\template', $data);
        return $this->blade->run('payroll.payroll', $data);
    }

    public function get($id)
    {
        return json_encode(Payroll::with('employee.position')->find($id)->toArray());
    }

    private function calculate_payroll($start, $end, $half)
    {
        $employees = Employee::with(['time_sheets' => function ($query2) use ($start, $end) {
            $query2->whereBetween('date', [$start, $end])->get();
        }])->get();

        $holidays = Holiday::with('holiday_type')->whereBetween('start', [$start, $end])->get();
        $period = CarbonPeriod::create($start, $end);
        $now = Carbon::now()->format('Y-m-d');


        foreach ($employees as $employee) {
//            $leaves = Leave::where('employee_id',$employee->id)->where('status','accepted')->get();
//            d($leaves);
            $ca = CashAdvance::where([['employee_id', $employee->id], ['balance', '!=', 0]])->get()->first();
            $daily_rate = $employee->basic_pay;
            $dtr_time = 0;
            $absent = 0;
            $late = 0;
            $basic_salary = $employee->monthly_pay / 2;
            $normal_ot = 0;
            // REST DAY AND SUNDAY HOLIDAYS
            $rd_sunday_ot = 0;
            $rd_regular_ot = 0;
            $rd_double_ot = 0;
            $rd_special_ot = 0;

            $rd_sunday_pre = 0;
            $rd_regular_pre = 0;
            $rd_double_pre = 0;
            $rd_special_pre = 0;

            // NORMAL DAY AND SUNDAY HOLIDAYS
            $nd_regular_ot = 0;
            $nd_double_ot = 0;
            $nd_special_ot = 0;

            $nd_regular_pre = 0;
            $nd_double_pre = 0;
            $nd_special_pre = 0;

            $total_ot = 0;
            $other_income = 0;
            $with_tax = 0;
            $cash_advance = ($ca ? ($ca->repayment > $ca->balance ? $ca->balance : $ca->repayment) : 0);
            $sss = 0;
            $hdmf = 0;
            $phi = 0;
            $sss_loan = 0;
            $hdmf_loan = 0;
            $other_deduction = 0;

            foreach ($period as $date) {

                $d = $date->format('Y-m-d');
                $day = $date->format('D');
                $time_sheet = $employee->time_sheets->where('date', '=', Carbon::parse($d))->first();
                $leave = Leave::where('employee_id', $employee->id)->whereRaw('? between request_start and request_end', [$d])->where('status', 'accepted')->first();
                //TODO Check if employee has time_sheet data for this day ;
                if ($leave) {
                    $dtr_time += 8;
                } elseif ($time_sheet) {
                    //TODO Check if holiday before proceeding;
                    $holidays_today = $holidays->where('start', '=', $d);
                    if (count($holidays_today) > 0) {
                        //TODO Count holiday for double pay
                        if (count($holidays_today) > 1) {
                            if ($day == 'Sun') {
                                $rd_double_pre += (double)$time_sheet->pre;
                                $rd_double_ot += (double)$time_sheet->ot;
                            } else {
                                $nd_double_pre += (double)$time_sheet->pre;
                                $nd_double_ot += (double)$time_sheet->ot;
                            }
                        } else {
                            //TODO Segregate according to holiday type
                            $holiday = $holidays_today->first();
                            if ($holiday->holiday_type->name == "Regular") {
                                if ($day == 'Sun') {
                                    $rd_regular_pre += (double)$time_sheet->pre;
                                    $rd_regular_ot += (double)$time_sheet->ot;
                                } else {
                                    $nd_regular_pre += (double)$time_sheet->pre;
                                    $nd_regular_ot += (double)$time_sheet->ot;
                                }
                            } else {
                                if ($day == 'Sun') {
                                    $rd_special_pre += (double)$time_sheet->pre;
                                    $rd_special_ot += (double)$time_sheet->ot;
                                } else {
                                    $nd_special_pre += (double)$time_sheet->pre;
                                    $nd_special_ot += (double)$time_sheet->ot;
                                }
                            }
                        }
                    } else {
                        if ($day == 'Sun') {
                            $rd_sunday_pre += (double)$time_sheet->pre;
                            $rd_sunday_ot += (double)$time_sheet->ot;
                        } else {
                            $normal_ot += (double)$time_sheet->ot;
                        }
                    }
                    $dtr_time += (double)$time_sheet->pre;
                    $late += (double)$time_sheet->late;
                    $total_ot += (double)$time_sheet->ot;
                } elseif ($day != 'Sun' && $now > $d) {
                    //TODO Check absent here;
                    $absent++;
                }
            }
            $absent_pay = $absent * $daily_rate;
            $late_pay = ($daily_rate / 480) * $late;
            $basic_salary -= $absent_pay + $late_pay;
            $normal_ot_pay = (($daily_rate / 8) * $normal_ot) * 1.25;
            $rd_sunday_ot_pay = (($daily_rate / 8) * $rd_sunday_ot) * 1.69;
            $rd_regular_ot_pay = (($daily_rate / 8) * $rd_regular_ot) * 3.38;
            $rd_double_ot_pay = (($daily_rate / 8) * $rd_double_ot) * 5.07;
            $rd_special_ot_pay = (($daily_rate / 8) * $rd_special_ot) * 1.95;
            $rd_sunday_pre_pay = (($daily_rate / 8) * 1.3) * $rd_sunday_pre;
            $rd_regular_pre_pay = (($daily_rate / 8) * 2.6) * $rd_regular_pre;
            $rd_double_pre_pay = (($daily_rate / 8) * 3.0) * $rd_double_pre;
            $rd_special_pre_pay = (($daily_rate / 8) * 1.5) * $rd_special_pre;
            $nd_regular_ot_pay = (($daily_rate / 8) * $nd_regular_ot) * 2.6;
            $nd_double_ot_pay = (($daily_rate / 8) * $nd_double_ot) * 3.9;
            $nd_special_ot_pay = (($daily_rate / 8) * $nd_special_ot) * 1.69;
            $nd_regular_pre_pay = (($daily_rate / 8) * 2.0) * $nd_regular_pre;
            $nd_double_pre_pay = (($daily_rate / 8) * 3.0) * $nd_double_pre;
            $nd_special_pre_pay = (($daily_rate / 8) * 1.3) * $nd_special_pre;

            $gross_pay = $basic_salary + $employee->total_allowance + $rd_sunday_pre_pay + $rd_regular_pre_pay + $rd_double_pre_pay + $rd_special_pre_pay;
            $gross_pay += $nd_regular_pre_pay + $nd_double_pre_pay + $nd_special_pre_pay;
            $gross_pay += $other_income;
            if ($employee->can_ot == 1) {
                $gross_pay += $normal_ot_pay + $rd_sunday_ot_pay + $rd_regular_ot_pay + $rd_double_ot_pay + $rd_special_ot_pay +
                    $nd_regular_ot_pay + $nd_double_ot_pay + $nd_special_ot_pay;
            }

            //0.073669 (2018)
            //.080 (2019 to present);
            if (!empty($employee->sss_no)) {
                $sss_lookup = SSSLookup::where('from', '<=', $employee->monthly_pay)->where('to', '>=', $employee->monthly_pay)->first();
                $sss = $sss_lookup->ss_ee / 2;
            }
            if (!empty($employee->pagibig_no)) {
                $hdmf = ($employee->monthly_pay * .02) / 2;
            }
            if (!empty($employee->philhealth_no)) {
                $phi = ($employee->monthly_pay * .03) / 4;
            }


            $total_deduction = $with_tax + $phi + $sss + $hdmf + $cash_advance + $sss_loan + $hdmf_loan + $other_deduction;
            $net_pay = $gross_pay - $total_deduction;

            $payroll = Payroll::updateOrCreate(
                ['employee_id' => $employee->id, 'from' => $start, 'to' => $end],
                [
                    'employee_id' => $employee->id,
                    'from' => $start,
                    'to' => $end,
                    'dtr_time' => round($dtr_time, 2),
                    'absent' => $absent,
                    'late' => $late,
                    'basic_salary' => round($basic_salary, 2),
                    'allowance' => round($employee->total_allowance, 2),
                    'normal_ot' => round($normal_ot, 2),
                    'normal_ot_pay' => round($normal_ot_pay, 2),

                    'rd_sunday_ot' => round($rd_sunday_ot, 2),
                    'rd_sunday_ot_pay' => round($rd_sunday_ot_pay, 2),
                    'rd_regular_ot' => round($rd_regular_ot, 2),
                    'rd_regular_ot_pay' => round($rd_regular_ot_pay, 2),
                    'rd_double_ot' => round($rd_double_ot, 2),
                    'rd_double_ot_pay' => round($rd_double_ot_pay, 2),
                    'rd_special_ot' => round($rd_special_ot, 2),
                    'rd_special_ot_pay' => round($rd_special_ot_pay, 2),

                    'rd_sunday_pay' => round($rd_sunday_pre_pay, 2),
                    'rd_regular_pay' => round($rd_regular_pre_pay, 2),
                    'rd_double_pay' => round($rd_double_pre_pay, 2),
                    'rd_special_pay' => round($rd_special_pre_pay, 2),

                    'nd_regular_ot' => round($nd_regular_ot, 2),
                    'nd_regular_ot_pay' => round($nd_regular_ot_pay, 2),
                    'nd_double_ot' => round($nd_double_ot, 2),
                    'nd_double_ot_pay' => round($nd_double_ot_pay, 2),
                    'nd_regular_pay' => round($nd_regular_pre_pay, 2),
                    'nd_special_ot' => round($nd_special_ot, 2),
                    'nd_special_ot_pay' => round($nd_special_ot_pay, 2),
                    'nd_double_pay' => round($nd_double_pre_pay, 2),
                    'nd_special_pay' => round($nd_special_pre_pay, 2),
                    'can_ot' => $employee->can_ot,
                    'total_ot' => round($total_ot, 2),
                    'other_income' => round($other_income, 2),
                    'gross_pay' => round($gross_pay, 2),
                    'with_tax' => round($with_tax, 2),
                    'phi' => round($phi, 2),
                    'sss' => round($sss, 2),
                    'hdmf' => round($hdmf, 2),
                    'cash_advance' => round($cash_advance, 2),
                    'sss_loan' => round($sss_loan, 2),
                    'hdmf_loan' => round($hdmf_loan, 2),
                    'other_deduction' => round($other_deduction, 2),
                    'total_deduction' => round($total_deduction, 2),
                    'net_pay' => round($net_pay, 2)
                ]
            );

            if ($ca) {

                $ca_detail = CashAdvanceDetail::updateOrCreate([
                    'cash_advance_id' => $ca->id,
                    'payroll_range' => Carbon::createFromFormat('Y-m-d', $start)->format('m-Y') . '-' . $half,
                    'payroll_id' => $payroll->id
                ], [
                    'cash_advance_id' => $ca->id,
                    'payroll_range' => Carbon::createFromFormat('Y-m-d', $start)->format('m-Y') . '-' . $half,
                    'payroll_id' => $payroll->id,
                    'amount_paid' => $cash_advance
                ]);

                if ($ca_detail->wasRecentlyCreated) {
                    $ca->balance = $ca->balance - $cash_advance;
                    $ca->save();
                }
            }

        }
    }

    public function update()
    {
        $key = (true ? "success" : "danger");
        $message = (true ? "Schedule updated successfully!" : "Opps! There is an error while updating the schedule.");
        return redirect()->route('payroll.index')->with('status', ['key' => "success", 'message' => "Schedule updated successfully!"]);
    }
}