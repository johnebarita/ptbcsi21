<div class="modal fade" id="edit_payroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xxl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Edit Payroll</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route_to('cash-advance.update') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="text" class="form-control" id="id" name="id" value="" hidden>
                    <div class="flex payroll_details_table">
                        <div class="w-50 mr-4 ">
                            <div class="mb-3">
                                <table class="edit-payroll-table w-100 table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class=" font-weight-normal"> Employee Basic Information
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td class="w-32" id="name" ></td>
                                        <td>Mobile No.</td>
                                        <td class="w-32" id="mobile"></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td id="address"></td>
                                        <td>Bank</td>
                                        <td id="bank"></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td id="email"></td>
                                        <td>Tin No.</td>
                                        <td id="tin_no"></td>
                                    </tr>
                                    <tr>
                                        <td>Company</td>
                                        <td id="company"></td>
                                        <td>SSS No.</td>
                                        <td id="sss_no"></td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td id="position"></td>
                                        <td>Philheath No.</td>
                                        <td id="philhealth_no"></td>
                                    </tr>
                                    <tr>
                                        <td>Home Tel. No.</td>
                                        <td id="tel_no"></td>
                                        <td>Pag-ibig No.</td>
                                        <td id="pagibig_no"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <table class="edit-payroll-table w-100 table-bordered ">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="pl-2 font-weight-normal"> Employee Time Record
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-right">DTR Time:</td>
                                        <td id="dtr_time"><input type="number"></td>
                                        <td class="text-right">Late:</td>
                                        <td id="late"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Leave:</td>
                                        <td id="leave"><input type="number"></td>
                                        <td class="text-right">Absent:</td>
                                        <td id="absent"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Total Over Time (hrs):</td>
                                        <td class="border-right-0" id="total_ot"><input type="number"></td>
                                        <td class="border-left-0" colspan="2"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <table class="edit-payroll-table w-100 table-bordered ">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="pl-2 font-weight-normal"> Employee Deduction
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-right">With Tax:</td>
                                        <td id="with_tax"><input type="number"></td>
                                        <td class="text-right" id="philhealth">PhilHealth:</td>
                                        <td id="number"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">SSS:</td>
                                        <td id="sss"><input type="number"></td>
                                        <td class="text-right">HDMF:</td>
                                        <td id="hdmf"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Cash Advance:</td>
                                        <td id="cash_Advance"><input type="number"></td>
                                        <td class="text-right">SSS Loan:</td>
                                        <td id="sss_loan"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Other Deduction:</td>
                                        <td id="other_deduction"><input type="number"></td>
                                        <td class="text-right">PAG-IBIG Loan:</td>
                                        <td id="pagibig_loan"><input type="number"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="w-50 ">
                            <div class="mb-3">
                                <table class="edit-payroll-table w-100 table-bordered ">
                                    <thead>
                                    <tr>
                                        <th colspan="4" class="pl-2 font-weight-normal"> Employee Income
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                      <td class="sub-header" colspan="4">Normal Day</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Basic Salary:</td>
                                        <td id="basic_salary"><input type="number"></td>
                                        <td class="text-right">Normal Day OT:</td>
                                        <td id="nd_ot_pay"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="sub-header" colspan="4">Rest Day and Sunday Holiday(s) Over Time</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Regular:</td>
                                        <td id="regular"><input type="number"></td>
                                        <td class="text-right">Double:</td>
                                        <td id="double"><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Regular:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Double:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="sub-header" colspan="4">Rest Day and Sunday Holiday(s)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Sunday:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Regular:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Special:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Double:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="sub-header" colspan="4">Holiday(s) Over Time</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Regular:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Special:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Double:</td>
                                        <td class="border-right-0"><input type="number"></td>
                                        <td class="border-left-0" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="sub-header" colspan="4">Holiday(s)</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Regular:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Special:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Double:</td>
                                        <td class="border-right-0"><input type="number"></td>
                                        <td class="border-left-0" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="sub-header" colspan="4">Others</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Allowance:</td>
                                        <td><input type="number"></td>
                                        <td class="text-right">Thirteenth Month:</td>
                                        <td><input type="number"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">Other Income:</td>
                                        <td class="border-right-0"><input type="number"></td>
                                        <td class="border-left-0" colspan="2"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>