<?php

declare(strict_types=1);

use Alibori\LaravelDbSizeAlerts\Mail\LaravelDbSizeAlertsMail;
use Illuminate\Support\Facades\Mail;

it(description: 'can send an email', closure: function () {
    Mail::fake();

    Mail::assertNothingSent();

    Mail::to(users: 'test@example.com')->send(new LaravelDbSizeAlertsMail(
        tables: ['users', 'posts', 'comments'],
        table_max_size: 1024,
    ));

    Mail::assertSent(mailable: LaravelDbSizeAlertsMail::class);
});
