<?php

declare(strict_types=1);

namespace Alibori\LaravelDbSizeAlerts\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

final class LaravelDbSizeAlertsMail extends Mailable
{
    use Queueable;

    public function __construct(
        public array $tables,
        public int $table_max_size,
    ) {
    }

    public function build(): self
    {
        return $this->view(view: 'laravel-db-size-alerts::emails.alert')
            ->subject(subject: 'Laravel DB Size Alerts')
            ->with([
                'tables' => $this->tables,
                'table_max_size' => $this->table_max_size,
            ]);
    }
}
