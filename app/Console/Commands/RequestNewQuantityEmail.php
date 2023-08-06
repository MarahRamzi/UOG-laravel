<?php

namespace App\Console\Commands;

use App\Mail\RequestQuantityEmailMailable;
use App\Models\Vendor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RequestNewQuantityEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:request-new-quantity-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send request for new quantity email to all vendors';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $vendors = Vendor::all();

        foreach ($vendors as $vendor) {
            Mail::to($vendor->email)
                ->send(new RequestQuantityEmailMailable($vendor));
        }

        $this->info('Request for new quantity emails sent to all vendors.');
    }

}