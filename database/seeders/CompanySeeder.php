<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert(
            array(
                array(
                    "company_name"       =>    "Amazon",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California"
                ),
                array(
                    "company_name"       =>    "Netflix",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "NVIDIA",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Salesforce",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",    
                ),
                array(
                    "company_name"       =>    "ServiceNow",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Square",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Analog Devices",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Palo Alto Networks",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Splunk",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Adobe Systems",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Broadcom",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Leidos",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "ON Semiconductor Corp.",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Match Group",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                ),
                array(
                    "company_name"       =>    "Tech Mahindra",
                    "phone_number"      =>    "9876543210",
                    "address"    =>    "USA, California",
                )
            )
        );
    }
}
