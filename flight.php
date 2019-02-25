<?php
  session_start();
  if($_SESSION['id'] != 2)
  {
    exit("Who are you?");
  }
 ?>


<html>

<head>
  <meta charset="utf-8">
  <title>Главная страница</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Покупка билета</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="/flight.php">Главная</a>
    <a class="p-2 text-dark" href="#">О нас</a>
  </nav>
</div>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Рейсы</h1>
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Номер</th>
              <th>Отправление</th>
              <th>Прибытие</th>
              <th>Дата отправления</th>
              <th>Дата прибытия</th>
              <th>Кол-во мест</th>
            </tr>
          </thead>
          <tbody id="tbody">
          </tbody>
        </table>
      </div>
    </div>
    <hr>
    <label class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Добавить пользователя</label>
  </div>
  <div id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Онлайн запись</h4>
            </div>
            <div class="modal-body">
                <form>
                  <div class="form-group" style="text-align:left">
                    <label>Ваше имя</label>
                    <input type="text" id="name" placeholder="Введите ваше имя" class="form-control">
                    <label>Номер рейса</label>
                    <select id="select" class="form-control">
                    </select>
                      <label>Дата</label>
                      <input type="date" id="date" class="form-control">
                      <label>Тип пассажира</label>
                      <select class="form-control" id="type">
                        <option>ADT (Adult) — взрослый</option>
              					<option>CHD (Child) — ребенок</option>
              					<option>INS (Infant with a seat) — младенец на отдельном месте</option>
              					<option>UNN (Unaccompanied Child) — ребенок без сопровождения</option>
                      </select>
                  </div>
                </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" onclick='modal_windwow()'>Записаться</button>
              <button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
        </div>
      </div>
  <script src="flight.js">

  </script>
</body>
</html>
