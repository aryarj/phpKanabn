<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      html,body {
        height:100%;
        width:100%;
        margin:0;
      }
      body {
        display:flex;
      }
      form {
        margin:auto;
      }
      table, th, td {
        border:1px solid black;
      }
    </style>
    <title>Kanban</title>
  </head>
  <body>

  <form action="Controller/loginValidation.php" target="_self" method="POST">
        <div class="form-group">
          <label for="exampleInputEmail1">Endereço de email</label>
          <input type="text" class="form-control" required name="email" id="email" aria-describedby="emailHelp" placeholder="Seu email">
          <small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu email, com ninguém.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Senha</label>
          <input type="password" class="form-control" required name="password" id="password" placeholder="Senha">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
<br><br>
        <p>---------------------------------------------------------------------------------</p>
        <p align="center">Atenção: Estou encontrando dificuldades em integrar o </p>
        <p align="center"> PHP com o Javascript e o programa está com alguns 'bugs', mas está evoluindo</p>
        <p>---------------------------------------------------------------------------------</p>
        <p>Emails e senhas para acessar o sistema:</p>
        <table>
          <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Senha</th>
          </tr>
          <tr>
            <td>Cláudia</td>
            <td>Leite</td>
            <td>cleite@gmail.com</td>
            <td>123</td>
          </tr>
          <tr>
            <td>Daniela</td>
            <td>Mercury</td>
            <td>dmercury@gmail.com</td>
            <td>123</td>
          </tr>
          <tr>
            <td>Ivete</td>
            <td>Sangalo</td>
            <td>isangalo@gmail.com</td>
            <td>123</td>
          </tr>
          <tr>
            <td>admin</td>
            <td>admin</td>
            <td>admin</td>
            <td>admin</td>
          </tr>
        </table> 

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
  </form>
  