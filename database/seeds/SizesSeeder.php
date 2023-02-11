<?php

use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertSize('ONESIZE', 0);

        $this->insertSize('S', 1);
        $this->insertSize('M', 2);
        $this->insertSize('L', 3);
        $this->insertSize('XL', 4);
        $this->insertSize('XXL', 5);
        $this->insertSize('XXXL', 6);

        $this->insertSize('35', 10);
        $this->insertSize('36', 11);
        $this->insertSize('37', 12);
        $this->insertSize('38', 13);
        $this->insertSize('39', 14);
        $this->insertSize('40', 15);
    }

    private function insertSize(string $name, int $order_num)
    {
        $model = new \App\Models\Sizes();

        $model->name = $name;
        $model->order_num = $order_num;

        $model->save();
    }
}
