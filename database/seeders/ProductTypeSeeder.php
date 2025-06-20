<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductType::insert([
            ['code' => 'liquid', 'name' => 'Liquid', 'description' => 'Products in fluid form, such as water, beverages, oils, or chemical solutions.'],
            ['code' => 'solid', 'name' => 'Solid', 'description' => 'Rigid products like tablets, powders, granules, or compressed materials.'],
            ['code' => 'semi_solid', 'name' => 'Semi-Solid', 'description' => 'Creams, gels, pastes, and other viscous substances that are not fully solid.'],
            ['code' => 'gas', 'name' => 'Gas', 'description' => 'Products in gaseous form, requiring pressurized containers or special handling.'],
            ['code' => 'powder', 'name' => 'Powder', 'description' => 'Finely ground substances like flour, protein powder, or chemical compounds.'],
            ['code' => 'aerosol', 'name' => 'Aerosol', 'description' => 'Products dispensed as a mist or spray, often pressurized (e.g., deodorants).'],
            ['code' => 'capsule', 'name' => 'Capsule', 'description' => 'Encapsulated products such as pharmaceutical or dietary supplements.'],
            ['code' => 'tablet', 'name' => 'Tablet', 'description' => 'Compressed solid dosage forms, typically used for medication.'],
            ['code' => 'suspension', 'name' => 'Suspension', 'description' => 'Liquids containing undissolved solid particles that require shaking before use.'],
            ['code' => 'emulsion', 'name' => 'Emulsion', 'description' => 'Mixtures of two immiscible liquids, like oil and water-based products.'],
            ['code' => 'paste', 'name' => 'Paste', 'description' => 'Thick, soft substances often used in cosmetics or industrial samples.'],
            ['code' => 'sample_kit', 'name' => 'Sample Kit', 'description' => 'Kits containing a mix of materials, instruments, or components to be analyzed.'],
        ]);

    }
}
