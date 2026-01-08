<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database Backup';

    /**
     * Create a new commad instance
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
        $filename = "backup_DrTarbi_" . strtotime(now()) . ".sql";
        $command = "\"C:\\laragon\\bin\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump\" --user=".env('DB_USERNAME')." --password=".env('DB_PASSWORD')." --host=" .env('DB_HOST') ." ".env('DB_DATABASE'). " > ".storage_path() . "/app/backup/" . $filename;
        exec($command);
    }
}
