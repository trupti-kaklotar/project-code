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
    <!-- <script src="https://gist.github.com/arkiver/5063175.js"></script> -->
    </body>

    <!-- <script src="cities.js"></script> -->
    <title>crud Operation - Form</title>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.min.css'; ?>"> -->
</head>




<body>

    <div class="container">
        <h3>Create User Table</h3>
        <hr>
        <?php echo form_open('user/save', 'role="form"'); ?>
        <!-- <form method="post" name="createUser" action="<?php echo base_url() . 'user/create'; ?>"> -->
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div> <br>

        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="address" id="address" class="form-control" required>

        </div> <br>

        <div class="form-group">
            <label>Mobile No.:</label>
            <!-- <input type="tel" id="phone" name="phone"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"><br><br> -->
            <input type="tel" name="mobno" value="" id="mobno" placeholder="" class="form-control" max-length="10" pattern="[7-9]{3}[0-9]{4}[0-9]{3}" required>
        </div> <br>

        <!--Country-->
        <div class="form-group">
            <label for="country">Country :</label>
            <select id="country_id" name="country" class="form-select" required>
                <option selected> Select Country </option>

                <?php
                foreach ($country as $key => $ctry) {
                    echo '<option value="' . $ctry['country_id'] . '">' . $ctry['country_name'] . '</option>';
                }
                ?>
            </select>
        </div> <br>

        <!--State-->
        <div class="form-group">
            <label for="state">State :</label>
            <select id="state_id" name="state" class="form-select" required>
                <option selected> Select state </option>
            </select>
        </div> <br>

        <!--City-->
        <div class="form-group">
            <label for="city">City :</label>
            <select id="city_id" name="city" class="form-select" required>
                <option selected> Select City </option>
            </select>
        </div> <br>

        <div class="form-group">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Create</button>
            <!-- <a href="<?php echo base_url() . 'user/index'; ?>" class="btn-primary btn">Create</a> -->
            <a href="<?php echo base_url() . 'user/index'; ?>" class="btn-warning btn">Cancel</a>
        </div>
        </form>
    </div>

</body>
<script>



    // Country Change

    $(document).ready(function() {
        $('#country_id').change(function() {
            var country = $(this).val();

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
                    $.each(response, function(index, data) {
                        $('#state_id').append('<option value="' + data['state_id'] + '">' + data['state_name'] + '</option>')
                    });
                }
            });
        });
    });


    $('#state_id').change(function() {
        var state = $(this).val();

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
                $.each(response, function(index, data) {
                    $('#city_id').append('<option value="' + data['city_id'] + '">' + data['city_name'] + '</option>');
                });
            }
        });
    });




    $("input[name=mobno]").attr("maxlength", "10");
    $('.mobno').keypress(function(e) {
        var arr = [];
        var kk = e.which;

        for (i = 48; i < 58; i++)
            arr.push();

        if (!(arr.indexOf(kk) >= 0))
            e.preventDefault();
    });


    
</script>

<!-- <script src="https://raw.githubusercontent.com/jheero/indiancities/main/cities.js"></script> -->

</html>