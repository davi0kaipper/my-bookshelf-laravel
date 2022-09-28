<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <style>

            .container {
                align-items: center;
                display: flex;
                height: 100vh;
                justify-content: center;
                width: 100vw;
            }

            .login {
                width: 320px;
            }

            .image {
                align-items: center;
                display: flex;
                justify-content: center;
                margin-bottom: 30px;
            }

        </style>
        <title>My Bookshelf</title>
    </head>
    <body>
        <div class="container">
            <div class="login">
                <div class="image">
                    <img src="/images/logo.png" alt="mybookshelf logo">
                </div>
                @if (! empty(session('success')))
                    <x-flash/>
                @endif
                <form method="post" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <x-error name="email"/>
                    </div>
                    <div class="mb-3">
                        <label for="password">Senha</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <x-error name="password"/>
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                    </div>
                    <div>
                        <a href="#">Cadastre-se</a>
                    </div>
                </form>
            <div>
        </div>
    </body>
</html>
