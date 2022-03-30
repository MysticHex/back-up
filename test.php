<?php
  if (isset($_POST['btn'])) {
    $hour=$_POST['hour'];
    $miniute = $_POST['miniute'];
    $second=$_POST['second'];
      if ($hour===0||$hour==="0"||$hour==='0') {
        
      }else{
        echo $hour." Jam ";
        // var_dump($hour);
      }
      if ($miniute===0||$miniute==="0"||$miniute==='0') {

      }else{
        echo $miniute." Menit ";
        // var_dump($miniute);
      }
      if ($second===0||$second==="0"||$second==='0') {

      }else{
        echo $second." Detik ";
        // var_dump($second);
      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</head>

<body>
  <div style="background-color: gray; width:max-content;">
    <form action="" method="post">
      <select name="hour" id="">
        <?php for ($i = 0; $i <= 23; $i++) { ?>
          <option value="<?= $i ?>"><?= $i; ?></option>
        <?php } ?>
      </select>
      Jam 
      <select name="miniute" id="">
        <?php for ($i = 0; $i <= 59; $i++) { ?>
          <option value="<?= $i ?>"><?= $i; ?></option>
        <?php } ?>
      </select>
      Menit 
      <select name="second" id="">
        <?php for ($i = 0; $i <= 59; $i++) { ?>
          <option value="<?= $i ?>"><?= $i; ?></option>
        <?php } ?>
      </select>
      Detik 
      <br>
      <button type="submit" name="btn">Submit</button>
    </form>
  </div>
</body>

</html>