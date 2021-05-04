<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- bootstrap cdn   -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <title>Form</title>
</head>

<body>

    <div class="container">
        <h3></h3>
        <div class="row">
            <div class="col-12">
                <a href="<?php echo site_url('user/add') ?>" class="btn btn-success float-right">Create</a>
            </div>
            <br>
            <!-- <form action="<?php echo base_url() . 'user/search'; ?>" method="post"> -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table id="example" class="table table-striped" style="width:100%">

                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile No.</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th colspan="1">Action</th>
                                </tr>
                                <br>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)) {
                                    foreach ($users as $user) {
                                        $datacountry = $this->db->query("Select country_name from uCountry where country_id='" . $user->uCountry . "'")->row_array();
                                        $datastate = $this->db->query("Select state_name from uState where state_id='" . $user->uState . "'")->row_array();
                                        $datacity = $this->db->query("Select city_name from uCity where city_id='" . $user->uCity . "'")->row_array();
                                ?>
                                        <tr>
                                            <td><?php echo $user->sno; ?></td>
                                            <td><?php echo $user->uName; ?></td>
                                            <td><?php echo $user->uAddress; ?></td>
                                            <td><?php echo $user->uMobno; ?></td>
                                            <td><?php echo (isset($datacountry['country_name'])) ? $datacountry['country_name'] : '-'; ?></td>
                                            <td><?php echo (isset($datastate['state_name'])) ? $datastate['state_name'] : '-'; ?></td>
                                            <td><?php echo (isset($datacity['city_name'])) ? $datacity['city_name'] : '-'; ?></td>

                                            <td><a href="<?php echo site_url('user/edit/' . $user->sno); ?>" class="btn btn-info">Edit</a>
                                                <a href="<?php echo site_url('user/delete/' . $user->sno); ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>

                                <?php }
                                } else {
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Mobile No.</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

</html>