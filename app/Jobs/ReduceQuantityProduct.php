<?php

namespace App\Jobs;

use App\Models\OrderItem;
use App\Services\ProductService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;

class ReduceQuantityProduct implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected ProductService $productService,
        protected Collection $itemCollection
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->itemCollection as $item){
            $this->productService->reduceQuatity($item->product, $item->quantidade);
        }
    }
}
