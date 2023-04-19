<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChartOfAccountGroups;

class ChartOfAccountGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chartOfAccountGroupNames = [
            'Account Payable',
            'Account Receivable',
            'Accumulated Depreciation',
            'Cash/Bank',
            'COGS',
            'Equity',
            'Expense',
            'Fixed Asset',
            'Inventory',
            'Long Term Liability',
            'Other Current Asset',
            'Other Current Liability',
            'Other Expense',
            'Other Income',
            'Revenue',
            'Supplies',
            'Liabilities',
        ];

        foreach ($chartOfAccountGroupNames as $chartOfAccountGroupName) {
            ChartOfAccountGroups::firstOrCreate(['name' => $chartOfAccountGroupName]);
        }
    }
}
