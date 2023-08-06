<?php

namespace App\Console\Commands;

use App\Mail\RequestQuantityEmailMailable;
use App\Models\Vendor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RequestQuantityEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:request-quantity-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $vendor = Vendor::find(2);

        if (!$vendor) {
            $this->error('Vendor not found.');
            return;
        }

        // Send the email
        Mail::to($vendor->email)
            ->send(new RequestQuantityEmailMailable());
        $this->info('Request quantity email sent to ' . $vendor->email);
    }

    }
