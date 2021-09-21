<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
    fieldset {
      display: flex;
      flex-direction: column;
    }

    input {
      width: 25%;
      margin-bottom: 1rem;
    }

    button {
      width: 20%;
      margin: 0 auto;
      cursor: pointer;
      border: 1px solid black;
      padding: .5rem 0;
      transition: all .3s;
    }

    button:hover {
      border: 1px solid transparent;
      background: gray;
      color: white;
    }
  </style>
</head>

<body>

  <form action="/correios/rastreio.php" method="POST">
    <fieldset>
      <legend>Correios</legend>
      <label for="user">Usúario</label>
      <input type="text" name="user" id="user" />

      <label for="password">Senha</label>
      <input type="password" name="password" id="password" />

      <label for="code">Código de rastreio</label>
      <input type="text" name="code" id="code" required />

      <button type="submit">Enviar</button>
    </fieldset>
  </form>
</body>

</html>