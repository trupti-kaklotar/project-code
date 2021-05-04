<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>crud Operation - Form</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>"> -->
</head>

<body>
    <div class="container">
    <h3>Update User</h3>
<?php //echo "<pre>"; print_r($state); die(); ?>
        <hr>
        <!-- <form action="<?php echo base_url('user/update/') ; ?>" method="post" name="createUser" > -->
        <?php echo form_open('user/update', 'role="form"'); ?>
        
            <div class="form-group">
                <!-- <label>S.No:</label> -->
                <input type="hidden" name="sno" value="<?php echo $Edit->sno ;?>">
             
            </div> <br>

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $Edit->uName; ?>" class="form-control" require>
        
            </div> <br>

            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" id="address" value="<?php echo $Edit->uAddress; ?>" class="form-control">
            
            </div> <br>

            <div class="form-group">
                <label>Mobile No.:</label>
                <input type="tel" name="mobno" value="<?php echo $Edit->uMobno; ?>" id="mobno" placeholder="xxxxxxxxxx" class="form-control" max-length="10" pattern="[7-9]{3}[0-9]{4}[0-9]{3}" required>
            </div> <br>

        <!--Country-->
            <div class="form-group">
                <label for="country">Country :</label>
                <select id="country" name="country" value="<?php echo  $Edit->uCountry; ?>" class="form-select" required>
           
                    <?php

                  foreach($country as $key=> $ctry){ ?>
                   <option value="<?php echo  $Edit->uCountry; ?>" selected> <?php echo form_dropdown('country_id', $Edit->uCountry, '#', 'id="country"'); ?></option>

                        <!-- <option value="<?php echo $ctry['country_id']; ?>"<?=$Edit->uCountry == $ctry['country_id'] ? ' selected="selected"' : '';?>><?php echo $ctry['country_name']?></option> -->
                        
                        <?php  } ?>                  
                </select>               
            </div> <br>

            <!--State-->
            <div class="form-group">
                <label for="state">State :</label>
                <select id="state_id" name="state" class="form-select" required>
                <?php echo form_dropdown('state_id', $state, '#', 'id="state"'); ?><br />

                <!-- <option value="<?php echo $state['state_id']; ?>"<?=$Edit->uState == $state['state_id'] ? ' selected="selected"' : '';?>><?php echo $state['state_name']?></option> -->
                
                <?php //echo "<pre>"; print_r($Edit-> uState); die();?>               
                     </select>              
            </div> <br>

            <!--City-->
            <div class="form-group">
                <label for="city">City :</label>
                <select id="city_id" name="city" class="form-select" required>
                    <option selected> <?php echo $Edit-> uCity ?> </option>    
                  
                </select>               
            </div> <br>

            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary" >                
                <a href="<?php echo base_url(). 'user/index'; ?>" class="btn-warning btn">Cancel</a>
            </div>
            </form>
            <?php echo form_close(); ?>
    </div>

</body>

<script type="text/javascript">// <![CDATA[
    $(document).ready(function(){
        $('#country').change(function(){ 
        $("#cities > option").remove(); //first of all clear select items
            var country_id = $('#country').val();  // here we are taking country id of the selected one.
            $.ajax({
                type: "POST",
                url: "User/get_state/"+country_id, //here we are calling our user controller and get_cities method with the country_id

                success: function(state) //we're calling the response json array 'cities'
                {
                    $.each(state,function(state_id,state) //here we're doing a foeach loop round each city with id as the key and city as the value
                    {
                        var opt = $('<option />'); // here we're creating a new select option with for each city
                        opt.val(id);
                        opt.text(state);
                        $('#state').append(opt); //here we will append these new select options to a dropdown with the id 'cities'
                    });
                }

            });

        });
    });
    // ]]>
</script>



<script>
// Country Change

// $(document).ready(function(){
//     $('#country_id').change(function(){
//         var country = $(this).val();
//         // var country = $('.country_id').val();
//         // alert(country);
//         // AJEX Request

//         $.ajax({
//             url: '<?=base_url()?>User/getcountrytostate',
//             method: 'post',
//             data: {country : country},
//             dataType : 'json',
//             success :function(response){

//                 // remove
//                 $('#city_id').find('option').not(':first').remove();
//                 $('#state_id').find('option').not(':first').remove();

//                 // add
//                 $.each(response,function(index,data){
//                     $('#state_id').append('<option value="'+data['state_id']+'">'+data['state_name']+'</option>')
//                 });
//             }
//         });
//     });
// });


// $('#state_id').change(function(){
//      var state = $(this).val();

//      // AJAX request
//      $.ajax({
//        url:'<?=base_url()?>User/getstatetocity',
//        method: 'post',
//        data: {state: state},
//        dataType: 'json',
//        success: function(response){
 
//          // Remove options
//          $('#city_id').find('option').not(':first').remove();

//          // Add options
//          $.each(response,function(index,data){
//            $('#city_id').append('<option value="'+data['city_id']+'">'+data['city_name']+'</option>');
//          });
//        }
//     });
//   });
 

// </script>


</html>