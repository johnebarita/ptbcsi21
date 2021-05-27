<?php


namespace App\Database\Seeds;


use CodeIgniter\Database\Seeder;

class SssLookupSeeder extends Seeder
{
    public function run()
    {

        $lowest = 3250;
        $highest = 20250;
        $range_increment = 500;
        $credit_increment = 250;
        $er_percent = 8.5 / 100;
        $ee_percent = 4.5 / 100;
        $from = 1;
        $to = $lowest;

        while ($to <= $highest) {
            $credit = $to - $credit_increment;
            $ss_er = $credit * $er_percent;
            $ss_ee = $credit * $ee_percent;
            $ss_total = $ss_er + $ss_ee;
            $ec_er = $credit >= 15000 ? 30 : 10;
            $tc_er = $ss_er + $ec_er;
            $tc_ee = $ss_ee;
            $tc_total = $tc_er + $tc_ee;

            $this->db->table('sss_lookups')->insert(
                [
                    "from" => $from,
                    "to" => $to==$highest?100000:$to-0.01,
                    "salary_credit" => $credit,
                    "ss_er" => $ss_er,
                    "ss_ee" => $ss_ee,
                    "ss_total" => $ss_total,
                    "ec_er" => $ec_er,
                    "tc_er" => $tc_er,
                    "tc_ee" => $tc_ee,
                    "tc_total" => $tc_total
                ]
            );

            $from = $to;
            $to += $range_increment;
        }

    }
}