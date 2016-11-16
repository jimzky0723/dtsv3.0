<?php

use Illuminate\Database\Seeder;

class TrackingFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tracking_filter')->insert([
            'doc_type' => 'TEV',
            'description' => 1,
            'amount' => 1,
            'pr_no' => 0,
            'po_no' => 0,
            'purpose' => 0,
            'source_fund' => 0,
            'requested_by' => 0,
            'route_to' => 0,
            'route_from' => 0,
            'supplier' => 0,
            'event_date' => 0,
            'event_location' => 0,
            'event_participant' => 0,
            'cdo_applicant' => 0,
            'cdo_day' => 0,
            'event_daterange' => 1,
            'payee' => 0,
            'item' => 0,
            'dv_no' => 0
        ]);

        DB::table('tracking_filter')->insert([
            'doc_type' => 'SAL',
            'description' => 1,
            'amount' => 1,
            'pr_no' => 0,
            'po_no' => 0,
            'purpose' => 0,
            'source_fund' => 0,
            'requested_by' => 0,
            'route_to' => 0,
            'route_from' => 0,
            'supplier' => 0,
            'event_date' => 0,
            'event_location' => 0,
            'event_participant' => 0,
            'cdo_applicant' => 0,
            'cdo_day' => 0,
            'event_daterange' => 1,
            'payee' => 0,
            'item' => 0,
            'dv_no' => 0
        ]);
    }
}
