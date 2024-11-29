<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategories; // تأكد من وجود هذا الاستيراد إذا كنت تستخدم النموذج

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\ServiceCategories::create(['name' => ' IMEI& FRP &Remote Server', 'description' => '   IMEI& FRP &Remote Server']);
        \App\Models\ServiceCategories::create(['name' => ' Server &Card & Games server', 'description' => '  Server &Card & Games server ']);
    
    }
}
