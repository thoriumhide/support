<?php
require 'db.php';
$data = $_POST;
$token = md5(uniqid(""));
$today = date("H:i:s d.m.y");

if( isset($data['do_add_ticket']) ){
  $errors = array();
  if( $data['name'] == '' ){
    $errors[] = 'Введите ФИО!';
  }
  if( trim($data['email']) == '' ){
    $errors[] = 'Введите E-mail!';
  }
  if( trim($data['phone']) == '' ){
    $errors[] = 'Введите номер телефона!';
  }
  if( $data['subject'] == '' ){
    $errors[] = 'Введите тему тикета!';
  }
  if( $data['text'] == '' ){
    $errors[] = 'Введите текст тикета!';

  }
  if( empty($errors) ){
    //Все хорошо добавляем в базу!
       $ticket = R::dispense( 'tickets' );
       $ticket -> name = $data['name'];
       $ticket -> email = $data['email'];
       $ticket -> phone = $data['phone'];
       $ticket -> subject = $data['subject'];
       $ticket -> text = $data['text'];
       $ticket -> token = $token;
       $ticket -> today = $today;

       R::store($ticket);
       echo '<div style="color: green;">Вы успешно отправили тикет!</div><hr>';
  }else {
    echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Support Blackgard</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="toptext">Отправить заявку в службу поддержки</div>
        </div>
        <div class="col-3"></div>
        <div class="col-6">
          <form action="/add_ticket.php" method="post">
            <div class="form-group">
              <label for="">ФИО:</label>
              <input type="text" name="name" class="form-control" placeholder="" value="<?php echo @$data['name'];?>">
            </div>
            <div class="form-group">
              <label for="">Почтовый ящик:</label>
              <input type="text" name="email" class="form-control" placeholder="" value="<?php echo @$data['email'];?>">
            </div>
            <div class="form-group">
              <label for="">Номер телефона:</label>
              <input type="text" name="phone" class="form-control" placeholder="" value="<?php echo @$data['phone'];?>">
            </div>
            <div class="form-group">
              <label for="">Тема:</label>
              <input type="text" id="" name="subject" class="form-control" placeholder="" value="<?php echo @$data['subject'];?>">
            </div>
            <div class="form-group">
              <label for="">Сообщение:</label>
              <textarea id="" name="text" class="form-control" rows="5" placeholder=""><?php echo @$data['text'];?></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="do_add_ticket">Отправить тикет</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
