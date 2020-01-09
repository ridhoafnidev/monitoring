<?php
    include 'db.php';

include 'session.php';

if(!isset($_SESSION["username"])){
    header("Location:../login.php");
}

    $oleh = $_SESSION ['username'];
    $nama = $_REQUEST ['nama'];
    // Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $db->prepare("SELECT * FROM user,semadema where semadema.nama_sema=user.nama and user.username='$nama'");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data Profil</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="../logo.ico"/>
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="../css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">


      <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <!-- Gritter -->


    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <script src="../sweetalert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../sweetalert/sweetalert.css">

</head>

<?php
include 'db.php';

if(isset($_POST['send'])){

$nama_himpunan=$_REQUEST['nama_himpunan'];
move_uploaded_file($_FILES["logo_himpunan"]["tmp_name"],"../images/" . $_FILES["logo_himpunan"]["name"]);
$logo=$_FILES["logo_himpunan"]["name"];
$periode=$_REQUEST['periode'];
move_uploaded_file($_FILES["pdf"]["tmp_name"],"../file/" . $_FILES["pdf"]["name"]);
$pdf=$_FILES["pdf"]["name"];
$visi=$_REQUEST['visi'];
$misi=$_REQUEST['misi'];
$ketua=$_REQUEST['ketua'];
$nim_ketua=$_REQUEST['nim_ketua'];
$wakil_ketua=$_REQUEST['wakil_ketua'];
$nim_wk=$_REQUEST['nim_wk'];
$sekretaris=$_REQUEST['sekretaris'];
$nim_sekre=$_REQUEST['nim_sekre'];
$bendahara=$_REQUEST['bendahara'];
$nim_bendahara=$_REQUEST['nim_bendahara'];


$insert = "update himpunan set logo_himpunan='$logo', periode='$periode', pdf='$pdf', visi='$visi', misi='$misi', ketua='$ketua', nim_ketua='$nim_ketua', wakil_ketua='$wakil_ketua', nim_wk='$nim_wk', sekretaris='$sekretaris', nim_sekre='$nim_sekre', bendahara='$bendahara', nim_bendahara='$nim_bendahara' where oleh='$oleh'";
$stmti = $db->prepare($insert);
$stmti->setFetchMode(PDO::FETCH_OBJ);
$stmti->execute();



  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Sukses!","Profil Himpunan Berhasil Di Simpan!","success");})</script>';
echo '<meta http-equiv="Refresh" content="1; URL=profil.php">';
}
?>
<body>
    <div id="wrapper">
        <?php include 'menu.php';

        ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php include 'header.php';
        ?>
                <div class="row  border-bottom white-bg dashboard-header">

                    <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Silahkan isi data profil</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <?php $no = 0;
                foreach ($data as $value) {
                    $no++;
                                             ?>
                        <div class="ibox-content">
                            <form  method="post" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group"><label class="col-sm-4 control-label">Nama Himpunan</label>

                                    <div class="col-sm-4"><input type="text" name="nama_himpunan"  class="form-control" value="<?php echo $value['nama']; ?>" required readonly></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Upload Logo Himpunan</label>
                                <div class="col-sm-4"><input type="file" name="logo_himpunan" class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Periode</label>

                                    <div class="col-sm-4"><input type="text" name="periode"  class="form-control" required></div>
                                </div>

                                <div class="form-group"><label class="col-sm-4 control-label">Upload Struktur Organisasi</label>
                                <div class="col-sm-4"><input type="file" name="pdf" class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Visi </label>

                                    <div class="col-sm-4"><input type="text" name="visi"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Misi </label>

                                    <div class="col-sm-4"><input type="text" name="misi"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Ketua </label>

                                    <div class="col-sm-4"><input type="text" name="ketua"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Nim Ketua</label> 

                                    <div class="col-sm-4"><input type="text" name="nim_ketua"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Wakil Ketua</label>

                                    <div class="col-sm-4"><input type="text" name="wakil_ketua"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Nim Wakil Ketua</label>

                                    <div class="col-sm-4"><input type="text" name="nim_wk"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Sekretaris</label>

                                    <div class="col-sm-4"><input type="text" name="sekretaris"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Nim Sekretaris</label>

                                    <div class="col-sm-4"><input type="text" name="nim_sekre"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Bendahara</label>

                                    <div class="col-sm-4"><input type="text" name="bendahara"  class="form-control" required></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Nim Bendahara</label>

                                    <div class="col-sm-4"><input type="text" name="nim_bendahara"  class="form-control" required></div>
                                </div>
                               

                              
                                

                                  <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-4"><button class="btn btn-sm btn-primary" type="submit" name="send"><strong>Submit</strong></button>
                                                    <a href="profil.php" class="btn btn-sm btn-danger">Batal</a></div>
                                                    </div>
                            </form>
                        </div>
                        <?php }
                 ?>
                    </div>
                </div>
            </div>




            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                        <div class="row">




                        </div>
                </div>

            </div>
            <?php
                include 'footer.php'
                ?>
        </div>

        </div>

                </div>
        </div>
    </div>



    <script src="../js/jquery-2.1.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Chosen -->
    <script src="../js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="../js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- Input Mask-->
    <script src="../js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="../js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="../js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="../js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="../js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="../js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="../js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="../js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="../js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="../js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="../js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


        });
        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        $("#basic_slider").noUiSlider({
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#range_slider").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        $("#drag-fixed").noUiSlider({
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>

    <!-- Mainly scripts -->




</body>
</html>
