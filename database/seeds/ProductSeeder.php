<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertProduct('Куртки 1', 5);
        $this->insertProduct('Штаны 1', 6);
        $this->insertProduct('Шорты 1', 7);
        $this->insertProduct('Майки 1', 8);
    }

    private function insertProduct(string $name, int $cat_id)
    {
        $model = new \App\Models\Products();

        $model->name = $name;
        $model->category_id = $cat_id;
        $model->price = 10;
        $model->image = '/uploads/products';

        $model->save();
    }
}
