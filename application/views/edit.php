<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <title>crud Operation - Form</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>"> -->
</head>

<body>
    <div class="container">
        <h3>Update User</h3>
        <?php //echo "<pre>"; print_r($state); die(); 
        ?>
        <hr>
        <!-- <form action="<?php echo base_url('user/update/'); ?>" method="post" name="createUser" > -->
        <?php echo form_open('user/update', 'role="form"'); ?>

        <div class="form-group">
            <!-- <label>S.No:</label> -->
            <input type="hidden" name="sno" value="<?php echo $Edit->sno; ?>">

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
            <!-- <input type="tel" name="mobno" value="" id="mobno" placeholder="" class="form-control" max-length="10" pattern="[7-9]{3}[0-9]{4}[0-9]{3}" required> -->

        </div> <br>

        <!--Country-->
        <div class="form-group">
            <label for="country">Country :</label>
            <select id="country_id" name="country" value="<?php echo  $Edit->uCountry; ?>" class="form-select" required>

                <?php foreach ($country as $key => $ctry) { ?>
                    <option value="<?php echo $ctry['country_id']; ?>" <?= $Edit->uCountry == $ctry['country_id'] ? ' selected="selected"' : ''; ?>>
                        <?php echo $ctry['country_name'] ?></option>

                <?php  } ?>
            </select>
        </div> <br>

        <!--State-->
        <div class="form-group">
            <label for="state">State :</label>

            <select id="state_id" name="state" value="<?php echo $Edit->uState ?>" class="form-select" required>
            <option value="<?php echo $Edit->uState ?>" selected>  </option>
            </select>
        </div><br>

        <!--City-->
        <div class="form-group">
            <label for="city">City :</label>
            <select id="city_id" name="city" value="<?php echo $Edit->uCity ?>" class="form-select" required>
            <option value="<?php echo $Edit->uCity ?> " selected> </option>
            </select>
        </div> <br>


        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
            <a href="<?php echo base_url() . 'user/index'; ?>" class="btn-warning btn">Cancel</a>
        </div>
        </form>
        <?php echo form_close(); ?>
    </div>

</body>




<script>
    // mobile number

    $("input[name=mobno]").attr("maxlength", "10");
    $('.mobno').keypress(function(e) {
        var arr = [];
        var kk = e.which;

        for (i = 48; i < 58; i++)
            arr.push();

        if (!(arr.indexOf(kk) >= 0))
            e.preventDefault();
    });


    // Country Change

    $(document).ready(function() {
        $('#country_id').change(function() {
            var country = $(this).val();
            alert(country);
            // AJEX Request

            $.ajax({
                url: '<?= base_url() ?>User/getcountrytostate',
                method: 'post',
                data: {
                    country: country
                },
                dataType: 'json',
                success: function(response) {

                    // remove
                    $('#city_id').find('option').not(':first').remove();
                    $('#state_id').find('option').not(':first').remove();

                    // add
                    // var response = {
                    //     // "country_id": "state_id"
                    //     "state_id": "state_name"
                    // };
                    // var $state_id = $('#state_id');

                    $.each(response, function(index, data) {
                        // var $option = $("<option/>", {
                        //     value: data['state_id'],
                        //     text: data['state_name']
                        // });

                        // $state_id.append($option);
                        $('#state_id').append('<option value="'+data['state_id']+'" >'+data['state_name'] +'</option>')
                    });
                }
            });
        });
    });


    $('#state_id').change(function() {
        var state = $(this).val();
        alert(state);
        // AJAX request
        $.ajax({
            url: '<?= base_url() ?>User/getstatetocity',
            method: 'post',
            data: {
                state: state
            },
            dataType: 'json',
            success: function(response) {

                // Remove options
                $('#city_id').find('option').not(':first').remove();

                // Add options
                // var response = {
                //     "state_id": "city_id"
                //     // "state_id": "state_name"                    
                // };
                // var $city_id = $('#city_id');

                $.each(response, function(index, data) {
                    // var $option = $("<option/>", {
                    //     value: data['city_id'],
                    //     text: data['city_name']
                    // });

                    // $city_id.append($option);

                    $('#city_id').append('<option value="' + data['city_id'] + '">' + data['city_name'] + '</option>');
                });
            }
        });
    });
</script>


</html>