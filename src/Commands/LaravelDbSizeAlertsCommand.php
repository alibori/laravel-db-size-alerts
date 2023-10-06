<?php

declare(strict_types=1);

namespace Alibori\LaravelDbSizeAlerts\Commands;

use Alibori\LaravelDbSizeAlerts\Mail\LaravelDbSizeAlertsMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LaravelDbSizeAlertsCommand extends Command
{
    public $signature = 'db-size:check';

    public $description = 'Command to check if the size of the desired tables is too big';

    public function handle(): int
    {
        $this->comment(string: 'Checking tables size...');

        $database = env(key: 'DB_DATABASE');

        $tables = config(key: 'db-size-alerts.tables');

        $table_max_size = config(key: 'db-size-alerts.table_max_mb_size');

        $tables_exceeded = [];

        foreach ($tables as $table) {
            $this->info(string: "Checking table {$table}...");

            $result = DB::select(query: /** @lang text */ "SELECT table_name AS `Table`, round(((data_length + index_length) / 1024 / 1024), 2) `size` FROM information_schema.TABLES WHERE table_schema = '{$database}' AND table_name = '{$table}'");

            $table_size = $result[0]->size;

            $this->info(string: "Table {$table} size is {$table_size} MB");

            if ($table_size > $table_max_size) {
                $this->error(string: "Table {$table} size is bigger than {$table_max_size} MB");

                $tables_exceeded[] = [
                    'name' => $table,
                    'size' => $table_size,
                ];
            }
        }

        if (count(value: $tables_exceeded) > 0) {
            $this->comment(string: 'Sending email to notify about the tables that exceeded the maximum size...');

            $emails_to_notify = config(key: 'db-size-alerts.emails_to_notify');

            if (count(value: $emails_to_notify) > 0 && config(key: 'app.env') !== 'local') {
                foreach ($emails_to_notify as $email) {
                    $this->info(string: "Sending email to {$email}...");

                    Mail::to($email)->send(new LaravelDbSizeAlertsMail(
                        tables: $tables_exceeded,
                        table_max_size: $table_max_size,
                    ));
                }
            }
        }

        return self::SUCCESS;
    }
}
