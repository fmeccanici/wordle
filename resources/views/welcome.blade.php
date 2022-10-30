<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TryCat</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body>
        <main @keyup.window="onKeyPress($event.key)"
              x-data="game">

            <h1 aria-label="TryCat">
                <img src="/images/trycat-logo.svg" alt="">
            </h1>
            <div
                id="game">
                <template x-for="(row, index) in board">
                    <div class="row" :class="{'current' : currentRowIndex === index, 'invalid' : currentRowIndex === index && errors}">
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
