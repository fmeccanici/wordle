<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TryCat</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body>
        <main @keyup.window="onKeyPress($event.key)"
              x-data="game">
            <div
                id="game">
                <template x-for="row in board">
                    <div class="row">
                        <template x-for="tile in row">
                            <div class="tile" :class="tile.status" x-text="tile.letter">

                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <output x-text="message"></output>
        </main>
    </body>

</html>
