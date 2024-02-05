<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Excel Grabber</title>

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/skeleton.css">
    <link rel="stylesheet" href="assets/css/toasty.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="container">Excel Data Grabber</div>
        </header>

        <section>
            <div class="container row">
                <div class="four columns">

                    <div class="card" style="margin-bottom: 40px;">
                        <form id="extract">
                            <h5>Выберите файл</h5>
                            <div class="row">
                                <select class="u-full-width" name="file"></select>
                                <input class="u-full-width" type="text" name="list" value="0">
                            </div>
                            <button class="u-full-width button-primary">Отправить</button>
                        </form>
                    </div>

                    <div class="card" style="margin-bottom: 40px;">
                        <form id="upload">
                            <h5>Загрузите файл</h5>
                            <div class="row">
                                <input class="u-full-width" type="file" name="file">
                            </div>
                            <button class="u-full-width button-primary">Загрузить</button>
                        </form>
                    </div>

                    <div class="card" style="margin-bottom: 40px;" id="getTemplate">
                        <h5>Получить шаблон</h5>
                        <button class="u-full-width button-primary">Получить</button>
                        <ul class="u-full-width">

                        </ul>
                    </div>

                    <div class="loader" style="display: none;"></div>

                </div>
                <div class="eight columns">
                    <div class="card">
                        <textarea id="fill" class="u-full-width" style="resize: none;height:70vh;"></textarea>
                    </div>
                </div>
            </div>
        </section>

        <footer>

        </footer>
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/toasty.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>