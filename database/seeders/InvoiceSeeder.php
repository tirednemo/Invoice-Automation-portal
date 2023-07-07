<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'id' => '1',
            'user_id' => '1',
            'invoice_date' => "2023-06-19 11:19:12",
            'invoice_no' => '1234',
            'customer_name' => 'Mr. alu',
            'phone' => '01768453421',
            'email' => 'alu@yahoo.com',
            'billing_address' => 'Road#5, Saturn',
            'shipping_address' => 'Road#5, Saturn',
            'total' => '10.00',
            'note' => 'no discount',
            'payee' => 'Earth Dept Store',
            'status' => 'Completed',
            'pdf_name' => 'time_sample_1.pdf',
        ]);

        Invoice::create([
            'id' => '2',
            'user_id' => '1',
            'invoice_date' => "2023-06-29 19:22:39",
            'invoice_no' => '3465',
            'customer_name' => 'Ms. potol',
            'phone' => '01768453421',
            'email' => 'princesspotol@gmail.com',
            'billing_address' => 'Road#7, Jupiter',
            'shipping_address' => 'Road#7, Jupiter',
            'total' => '540.00',
            'note' => 'no discount',
            'payee' => '9/11',
            'status' => 'Due',
            'pdf_name' => 'time_sample_2.pdf',
        ]);
    }
}
