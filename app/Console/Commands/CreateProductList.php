<?php

namespace App\Console\Commands;

use Helper;
use App\Models\Product;
use Illuminate\Console\Command;
use DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateProductList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_product_list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::getQuery()->leftJoin('brand', 'product.brand_id', '=', 'brand.id')->select('product.*', DB::raw('brand.name as brand_name'))->get();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load(storage_path("app/list-products.xlsx"));

        $sheet = $spreadsheet->getActiveSheet();
        foreach($products as $index => $product) {
            $sheet->setCellValue('A'.(2+$index), $product->id);
            $sheet->setCellValue('B'.(2+$index), $product->name);
            $sheet->setCellValue('C'.(2+$index), empty($product->meta_desc) ? Helper::cutString(strip_tags($product->content), 160) : $product->meta_desc);
            $sheet->setCellValue('D'.(2+$index), $product->getDetailLink());
            $sheet->setCellValue('E'.(2+$index), $product->getImage(426, 320));
            $sheet->setCellValue('F'.(2+$index), $product->getStatusText());
            $sheet->setCellValue('G'.(2+$index), ($product->regular_price > 0) ? ($product->regular_price. ' VND') : ($product->price > 0 ? $product->price. ' VND' : 'Liên hệ'));
            $sheet->setCellValue('H'.(2+$index), ($product->getPrice() > 0) ? ($product->getPrice(). ' VND') : 'Liên hệ');
            $sheet->setCellValue('I'.(2+$index), $product->brand_name);
        }
        $writer = new Xlsx($spreadsheet);
        $filePath =  base_path().'/public/list-products.xlsx';

        $writer->save($filePath);
        echo "Done";
    }
}
