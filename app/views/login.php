<!--Daniel Sanchez Medialdea-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Biblioteca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .session-expired {
            background-color: #ffcccb;
            color: #d8000c;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            width: 90%;
            max-width: 400px;
            border: 1px solid #d8000c;
        }

        form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            width: 90%;
            max-width: 400px;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #0065ff;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .buttons a {
            text-decoration: none;
            width: 100%;
        }

        button {
            background-color: #004dc7;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #00327e;
        }

        .error {
            color: #ff5646;
            font-size: 12px;
            display: block;
            margin-top: 3px;
        }

    </style>
</head>
<body>

<h1>Biblioteca</h1>


<form action="/user/storelogin" method="post">

    <span class="error"><?= $errors["login"] ?? "" ?></span>

    <label for="email">Email del cliente: </label>
    <input type="text" id="email" name="email">
    <span class="error"><?= $errors["email"] ?? "" ?></span>
    <br>

    <label for="password">Contraseña: </label>
    <input type="password" id="password" name="password">
    <span class="error"><?= $errors["password"] ?? "" ?></span>

    <div class="buttons">
        <button type="submit">Entrar</button>

    </div>

</form>

</body>
</html>