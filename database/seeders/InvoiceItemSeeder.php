<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvoiceItem;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceItem::create([
            'id' => '1',
            'invoice_id' => '1',
            'item_name' => 'Cheese Puffs',
            'quantity' => '1',
            'unit_price'=> '10.00',
            'amount' => '10.00',
        ]);

        InvoiceItem::create([
            'id' => '2',
            'invoice_id' => '2',
            'item_name' => 'Cadbury',
            'quantity' => '2',
            'unit_price'=> '150.00',
            'amount' => '300.00',
        ]);
        InvoiceItem::create([
            'id' => '3',
            'invoice_id' => '2',
            'item_name' => 'Snickers',
            'quantity' => '3',
            'unit_price'=> '80.00',
            'amount' => '240.00',
        ]);
    }
}
