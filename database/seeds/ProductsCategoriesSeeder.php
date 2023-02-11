<?php

use Illuminate\Database\Seeder;

class ProductsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertCategory('Одежда', 'clothes');
        $this->insertCategory('Сумки', 'bags');
        $this->insertCategory('Обувь', 'shoes');
        $this->insertCategory('Аксессуары', 'accessories');
    }

    private function insertCategory(string $name, string $slug)
    {
        $model = new \App\Models\ProductsCategories();

        $model->name = $name;
        $model->slug = $slug;

        $model->save();
    }
}
