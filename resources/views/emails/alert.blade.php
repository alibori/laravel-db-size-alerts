<p>
    Hello, <br>

    Some of the project's database tables has exceeded the maximum size of {{ $table_max_size }} MB. Here are the details: <br>

    @foreach ($tables as $table)
        <b>Table name:</b> {{ $table['name'] }} <br>
        <b>Table size:</b> {{ $table['size'] }} MB <br>
        <br>
    @endforeach

    Thanks for using the alibori/laravel-db-size-alerts package!
</p>
