<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>student registion</title>
  </head>
  <body>
  
    <div class="container">
        <div class="row">
            <div class="col-sm-10 mx-auto my-4">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Sl.no</th>
                <th scope="col">Teacher Name</th>
                <th scope="col">Teacher Dob</th>
                <th scope="col">Teacher Number</th>
                <th scope="col">Teacher Email</th>
                <th scope="col">Teacher Profile photo</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <!--   SELECT `tech_id`, `tech_name`, `tech_dob`, `tech_num`, `tech_email`, `tech_pic`, `tech_cancel -->
            <tr>
              <?php 
              $sl=0;
                if(count($teacher)){
                  foreach ($teacher as $data){
                    $sl++;
               
              ?>
                <td><?= $sl;?></td>
                <td><?= $data->tech_name ;?></td>
                <td><?= $data->tech_dob ;?></td>
                <td><?= $data->tech_num ;?></td>
                <td><?= $data->tech_email ;?></td>
                <td><img src="<?= base_url('uplode/teacher_data/'.$data->tech_pic) ;?>" style="height:50px;width:60px"></td>
                <td> 
                <a class="btn btn-sucess"href="<?= base_url('teacher_information_edit/'.$data->tech_id)?>">edit</a>
                </td> 
            </tr>

            <?php }} ?>
            </tbody>
            </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>