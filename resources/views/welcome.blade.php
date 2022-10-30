<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TryCat</title>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    <div id="game" x-data="{guessesAllowed : 4, wordLength : 3}">
        <template x-for="row in Array.from({length : guessesAllowed})">
            <div class="row">
                <template x-for="tile in Array.from({length : wordLength})">
                    <div class="tile">

                    </div>
                </template>
            </div>
        </template>

    </div>

    </body>
</html>
