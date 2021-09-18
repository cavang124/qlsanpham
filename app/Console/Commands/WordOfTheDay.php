<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check date expired of product';

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
     * @return int
     */
    public function handle()
    {
        $product = Product::all();
        foreach($product as $item){
            $date = strtotime(now()) + 60*60*12 ;
            $date_expired = strtotime($item['date_expired']);
            if($date_expired <= $date && $item['status'] == 1){
                $item->update([
                    'status' => 3,
                ]);
            }

        }
    }
}
