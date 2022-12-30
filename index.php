<?php

require __DIR__.'/Controller/TodoController.php';


$list = findAll();
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <style>
            tr:hover {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
    <h2 class="text-center">Todo List</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-sm-12">
                <form action="/todo/Controller/TodoController.php" method="post">
                    <div class="mb-3 d-flex">
                        <input type="text" name="edit" value="" hidden id="idTodo">
                        <label for="todo" class="form-label" hidden>Text:</label>
                        <input type="text" class="form-control me-1" id="todo" name="todo" placeholder="Todo text"
                               value="<?= $todo != "" ? $todo->getText() : "" ?>">
                        <button type="submit" class="btn btn-primary">+</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="alert alert<?= isset($_SESSION['success']) ? "-success" : "";
        echo isset($_SESSION['info']) ? "-info" : "";echo isset($_SESSION['danger']) ? "-danger" : "";?>" role="alert">

            <?= isset($_SESSION['success']) ? $_SESSION['success'] : "";?>
            <?= isset($_SESSION['danger']) ? $_SESSION['danger'] : "";?>
            <?= isset($_SESSION['info']) ? $_SESSION['info'] : ""; ?>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">to do</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                    <th scope="col">edit</th>
                    <th scope="col">remove</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $key => $item): ?>
                    <tr class="lista">
                        <th scope="row"><?= $key + 1 ?></th>
                        <td class="w-75" id="textInfo"><?= $item->getText() ?></td>
                        <td> <?= $item->getCreatedAt() ?> </td>
                        <td> <?= $item->getUpdatedAt() ?> </td>
                        <td>
                            <a id="<?= $item->getId() ?>" href="#" type="button" class="btn btn-info editar"><i
                                        class="bi bi-pencil-square"></i></a>
                        </td>
                        <td>
                            <a href="/todo/Controller/TodoController.php?id=<?= $item->getId() ?>" type="button"
                               class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <script>

        const botaoEditar = document.querySelectorAll('.editar');
        botaoEditar.forEach(function (event) {
            event.preventDefault;
            event.addEventListener('click', () => {
                // console.log(event.id);
                const textTr = event.parentNode.parentNode.querySelector('#textInfo');
                console.log(textTr);
                const inputId = document.querySelector('#idTodo');
                // console.log(inputId)
                inputId.setAttribute('value', event.id);
                const form = document.querySelector('form');
                form.method = 'GET'
                console.log(form.todo.setAttribute('value', textTr.textContent))
            })
        })
    </script>

    </body>
    </html>
<?php session_destroy(); ?>