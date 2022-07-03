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
                <?php 

                $message=$this->session->flashdata('message');
                $error=$this->session->flashdata('error');
                if($message){
                    echo $message;
                }else{
                    echo  $error;
                }
                ?>
                <div class="card p-4">
                    <h1 class="text-center p-2 card-title">teacher registion</h1>
                    <hr> 
                    <form action="<?= base_url('teacher_informationAdd'); ?>" method="POST" enctype="multipart/form-data" >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Teacher Name</label>
                                <input type="text" name="tech_name" class="form-control" value="<?= set_value('tech_name')?>" placeholder="Enter Your Name">
                                <?= form_error('tech_name');?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Teacher DOB</label>
                                <input type="date" class="form-control" name="tech_dob" value="<?= set_value('tech_dob')?>" placeholder="Enter your Email">
                                <?= form_error('tech_dob');?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">teacher Mobail Number</label>
                                <input type="tel" class="form-control" name="tech_num" value="<?= set_value('tech_num')?>" placeholder="enter your mobail number">
                                <?= form_error('tech_num');?>
                            </div>
                             <div class="form-group col-md-6">
                                <label for="inputPassword4">Teacher Email</label>
                                <input type="password" name="tech_email" class="form-control" value="<?= set_value('tech_email')?>" placeholder="enter your Password">
                                <?= form_error('tech_email');?>
                            </div>
                        </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Teacher Photo</label>
                                <input type="file" name="tech_pic" class="form-control" value="<?= set_value('tech_pic')?>" placeholder="enter your Password">
                                <?= form_error('tech_pic');?>
                            </div>
                            <div class="text-right p-">
                                <button type="submit" class="btn btn-primary">Sign in</button>                            
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>