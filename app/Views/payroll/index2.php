<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payroll</h1>
    </div>
    <?php if (session()->has('success')) { ?>
        <div class="alert alert-success alert-dismissible fade show " role="alert">
            <?= session('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div>
                <div class="flex select-md">
                    <div class="flex-sm-grow-1 ">
                        <form action="<?= route_to('payroll.index') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group flex ml-auto">
                                <label for="half" class="m-auto pr-2">Filter: </label>
                                <select class="form-control  mr-2 select-small" name="half" id="half">
                                    <option <?= ($half == "A" ? "selected" : '') ?>>A</option>
                                    <option <?= ($half == "B" ? "selected" : '') ?>>B</option>
                                </select>
                                <select class="form-control mr-2 w-50" name="month" id="month">
                                    <option value='01' <?= ($month == '01' ? 'selected' : ''); ?>>January</option>
                                    <option value='02' <?= ($month == '02' ? 'selected' : ''); ?>>February</option>
                                    <option value='03' <?= ($month == '03' ? 'selected' : ''); ?>>March</option>
                                    <option value='04' <?= ($month == '04' ? 'selected' : ''); ?>>April</option>
                                    <option value='05' <?= ($month == '05' ? 'selected' : ''); ?>>May</option>
                                    <option value='06' <?= ($month == '06' ? 'selected' : ''); ?>>June</option>
                                    <option value='07' <?= ($month == '07' ? 'selected' : ''); ?>>July</option>
                                    <option value='08' <?= ($month == '08' ? 'selected' : ''); ?>>August</option>
                                    <option value='09' <?= ($month == '09' ? 'selected' : ''); ?>>September</option>
                                    <option value='10' <?= ($month == '10' ? 'selected' : ''); ?>>October</option>
                                    <option value='11' <?= ($month == '11' ? 'selected' : ''); ?>>November</option>
                                    <option value='12' <?= ($month == '12' ? 'selected' : ''); ?>>December</option>
                                </select>
                                <select class="form-control  mr-2 w-25" name="year" id="year">
                                    <option <?= ($year == "2020" ? "selected" : '') ?>>2020</option>
                                    <option <?= ($year == "2019" ? "selected" : '') ?>>2019</option>
                                </select>
                                <input type="submit" class="btn btn-primary" value="GO"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <table class=" table-bordered payroll-table text-center w-100" style="overflow: scroll">
                    <tr>
                        <th>No.</th>
                        <th>Employee Name</th>
                        <th>Daily Rate</th>
                        <th>Monthly Rate</th>
                        <th>DTR Time</th>
                        <th># Day(s) Absent</th>
                        <th>Late(min)</th>
                        <th>Basic Salary</th>
                        <th>Allowance</th>
                        <th>Normal OT</th>
                        <th>Normal OT Pay</th>
                        <th>Sunday OT</th>
                        <th>Sunday OT Pay</th>
                        <th>Sunday Regular OT</th>
                        <th>Sunday Regular Pay</th>
                        <th>Sunday Double OT</th>
                        <th>Sunday Double Pay</th>
                        <th>Sunday Special OT</th>
                        <th>Sunday Special Pay</th>
                        <th>Sunday Pay</th>
                        <th>Sunday Regular Pay</th>
                        <th>Sunday Double Pay</th>
                        <th>Sunday Special Pay</th>

                        <th>Regular OT</th>
                        <th>Regular Pay</th>
                        <th>Double OT</th>
                        <th>Double Pay</th>
                        <th>Special OT</th>
                        <th>Special Pay</th>

                        <th>Regular Pay</th>
                        <th>Double Pay</th>
                        <th>Special Pay</th>
                        <th>Total OT</th>
                        <th>Other Income</th>
                        <th>Gross Pay</th>
                        <th>With Tax</th>
                        <th>Phi</th>
                        <th>SSS</th>
                        <th>HDMF</th>
                        <th>Cash Advance</th>
                        <th>SSS Loan</th>
                        <th>PAG-IBIG Loan</th>
                        <th>Other Deduction</th>
                        <th>Total Deduction</th>
                        <th>Net Pay</th>
                    </tr>
                    <?php
                    $count = 1;
                    foreach ($positions as $position) {
                        ?>
                        <tr class="text-left">
                            <td colspan="46"><?= $position->position ?></td>
                        </tr>
                        <?php foreach ($position->employees as $employee) {
                            $payroll = $employee->payrolls->first();
                            $can_ot = "strikethrough";

                            ?>
                            <tr>
                                <td><?= $count++; ?></td>
                                <td><?= strtoupper($employee->lastname . ' ' . $employee->firstname . ' ' . $employee->middle); ?></td>
                                <td><?= $employee->basic_pay; ?></td>
                                <td><?= $employee->monthly_pay; ?></td>
                                <td><?= ($payroll->dtr_time!=0?$payroll->dtr_time:''); ?></td>
                                <td><?= ($payroll->absent!=0?$payroll->absent:''); ?></td>
                                <td><?= ($payroll->late!=0?$payroll->late:''); ?></td>
                                <td><?= ($payroll->basic_salary!=0?$payroll->basic_salary:''); ?></td>
                                <td><?= ($payroll->allowance!=0?$payroll->allowance:''); ?></td>

                                <td class="<?= $can_ot ?>"><?= ($payroll->normal_ot!=0?$payroll->normal_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->normal_ot_pay!=0?$payroll->normal_ot_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_sunday_ot!=0?$payroll->rd_sunday_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_sunday_pay!=0?$payroll->rd_sunday_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_regular_ot!=0?$payroll->rd_regular_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_regular_pay!=0?$payroll->rd_regular_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_double_ot!=0?$payroll->rd_double_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_double_pay!=0?$payroll->rd_double_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_special_ot!=0?$payroll->rd_special_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_special_pay!=0?$payroll->rd_special_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_sunday_pay!=0?$payroll->rd_sunday_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_regular_pay!=0?$payroll->rd_regular_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_double_pay!=0?$payroll->rd_double_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->rd_special_pay!=0?$payroll->rd_special_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_regular_ot!=0?$payroll->nd_regular_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_regular_pay!=0?$payroll->nd_regular_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_double_ot!=0?$payroll->nd_double_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_double_pay!=0?$payroll->nd_double_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_special_ot!=0?$payroll->nd_special_ot:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_special_pay!=0?$payroll->nd_special_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_regular_pay!=0?$payroll->nd_regular_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_double_pay!=0?$payroll->nd_double_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->nd_special_pay!=0?$payroll->nd_special_pay:''); ?></td>
                                <td class="<?= $can_ot ?>"><?= ($payroll->total_ot!=0?$payroll->total_ot:''); ?></td>

                                <td><?= ($payroll->other_income!=0?$payroll->other_income:''); ?></td>
                                <td><?= ($payroll->gross_pay!=0?$payroll->gross_pay:''); ?></td>
                                <td><?= ($payroll->with_tax!=0?$payroll->with_tax:''); ?></td>
                                <td><?= ($payroll->phi!=0?$payroll->phi:''); ?></td>
                                <td><?= ($payroll->sss!=0?$payroll->sss:''); ?></td>
                                <td><?= ($payroll->hdmf!=0?$payroll->hdmf:''); ?></td>
                                <td><?= ($payroll->cash_advance!=0?$payroll->cash_advance:''); ?></td>
                                <td><?= ($payroll->sss_loan!=0?$payroll->sss_loan:''); ?></td>
                                <td><?= ($payroll->hdmf_loan!=0?$payroll->hdmf_loan:''); ?></td>
                                <td><?= ($payroll->other_deduction!=0?$payroll->other_deduction:''); ?></td>
                                <td><?= ($payroll->total_deduction!=0?$payroll->total_deduction:''); ?></td>
                                <td><?= ($payroll->net_pay!=0?$payroll->net_pay:''); ?></td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>
        </div>

    </div>
</div>
