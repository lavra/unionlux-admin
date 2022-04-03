<?php
    
    use App\Product;
    use App\Category;
    use Illuminate\Database\Seeder;
    
    class CategoryTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $id = mt_rand(1, '12345');
            $idPro = mt_rand(1, '123456789');
            $date = date('Y-m-d H:i:s');
            
            Category::create([
                'id' => $id,
                'name' => 'Categoria 1',
                'slug' => 'categoria-1',
                'description' => 'Descrição da categoria 1',
                'image' => 'images/facks/categories/img1.png',
                'order' => '01',
                'active' => 1,
                'created_at' => $date
            ]);
            
            Category::create([
                'id' => $id+1,
                'name' => 'Categoria 2',
                'slug' => 'categoria-2',
                'description' => 'Descrição da categoria 2',
                'image' => 'images/facks/categories/img2.png',
                'order' => '02',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Category::create([
                'id' => $id+2,
                'name' => 'Categoria 3',
                'slug' => 'categoria-3',
                'description' => 'Descrição da categoria 3',
                'image' => 'images/facks/categories/img3.png',
                'order' => '03',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Category::create([
                'id' => $id+3,
                'name' => 'Categoria 4',
                'slug' => 'categoria-4',
                'description' => 'Descrição da categoria 4',
                'image' => 'images/facks/categories/img4.png',
                'order' => '04',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Category::create([
                'id' => $id+4,
                'name' => 'Categoria 5',
                'slug' => 'categoria-5',
                'description' => 'Descrição da categoria 5',
                'image' => 'images/facks/categories/img5.png',
                'order' => '05',
                'active' => 1,
                'created_at' => $date
            ]);
            Category::create([
                'id' => $id+5,
                'name' => 'Categoria 6',
                'slug' => 'categoria-6',
                'description' => 'Descrição da categoria 6',
                'image' => 'images/facks/categories/img6.png',
                'order' => '06',
                'active' => 1,
                'created_at' => $date
            ]);

            /**
             * Create Product
             */
            Product::create([
                'id' => $idPro,
                'category_id' => $id,
                'name' => 'Produto 1',
                'slug' => 'produto-1',
                'description' => 'Descrição do produto 1',
                'image' => 'images/facks/products/img1.png',
                'order' => '01',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Product::create([
                'id' => $idPro+1,
                'category_id' => $id+1,
                'name' => 'Produto 2',
                'slug' => 'produto-2',
                'description' => 'Descrição do produto 2',
                'image' => 'images/facks/products/img2.png',
                'order' => '02',
                'active' => 1,
                'created_at' => $date
            ]);
            Product::create([
                'id' => $idPro+2,
                'category_id' => $id+2,
                'name' => 'Produto 3',
                'slug' => 'produto-3',
                'description' => 'Descrição do produto 3',
                'image' => 'images/facks/products/img3.png',
                'order' => '03',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Product::create([
                'id' => $idPro+3,
                'category_id' => $id+3,
                'name' => 'Produto 4',
                'slug' => 'produto-4',
                'description' => 'Descrição do produto 4',
                'image' => 'images/facks/products/img4.png',
                'order' => '04',
                'active' => 1,
                'created_at' => $date
            ]);
    
            Product::create([
                'id' => $idPro+4,
                'category_id' => $id+4,
                'name' => 'Produto 5',
                'slug' => 'produto-5',
                'description' => 'Descrição do produto 5',
                'image' => 'images/facks/products/img5.png',
                'order' => '05',
                'active' => 1,
                'created_at' => $date
            ]);
            Product::create([
                'id' => $idPro+5,
                'category_id' => $id+5,
                'name' => 'Produto 6',
                'slug' => 'produto-6',
                'description' => 'Descrição do produto 6',
                'image' => 'images/facks/products/img6.png',
                'order' => '06',
                'active' => 1,
                'created_at' => $date
            ]);
        }
    }





