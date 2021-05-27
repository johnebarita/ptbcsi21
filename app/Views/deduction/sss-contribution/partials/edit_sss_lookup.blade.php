<div class="modal fade" id="edit_sss_lookup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLabel">Edit SSS Contribution</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <form method="post" action="{{route_to("sss-contribution-table.update")}}" id="edit_sss_lookup">
                    @csrf
                    <input type="text" id="edit_sss_lookup_id" name="id" hidden>
                    <table class="sss-contribution-table w-100 table-bordered">
                        <thead>
                        <tr>
                            <th rowspan="2" class="w-ten">Compensation</th>
                            <th rowspan="2" class="w-ten">Compensation</th>
                            <th rowspan="2" class="w-ten">Salary</th>
                            <th colspan="7">Employer - Employee</th>
                        </tr>
                        <tr>
                            <th colspan="3">Social Security</th>
                            <th>EC</th>
                            <th colspan="3">Total Contribution</th>
                        </tr>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Credit</th>
                            <th>ER</th>
                            <th>EE</th>
                            <th>Total</th>
                            <th>ER</th>
                            <th>ER</th>
                            <th>EE</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="number" step=".01" id="edit_from" name="from" class="w-100 m-1"></td>
                            <td><input type="number" step=".01" id="edit_to" name="to" class="w-100 m-1"></td>
                            <td><input type="number" step=".01" id="edit_salary_credit" name="salary_credit" class="w-100 m-1"></td>
                            <td><input type="number" step=".01" id="edit_ss_er" name="ss_er" class="w-100 m-1 ss_input"></td>
                            <td><input type="number" step=".01" id="edit_ss_ee" name="ss_ee" class="w-100 m-1 ss_input"></td>
                            <td><input type="number" step=".01" id="edit_ss_total" name="ss_total" class="w-100 m-1" readonly></td>
                            <td><input type="number" step=".01" id="edit_ec_er" name="ec_er" class="w-100 m-1"></td>
                            <td><input type="number" step=".01" id="edit_tc_er" name="tc_er" class="w-100 m-1 tc_input"></td>
                            <td><input type="number" step=".01" id="edit_tc_ee" name="tc_ee" class="w-100 m-1 tc_input"></td>
                            <td><input type="number" step=".01" id="edit_tc_total" name="tc_total" class="w-100 m-1" readonly></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer mt-3">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>