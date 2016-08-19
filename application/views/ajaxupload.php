<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Welcome to CodeIgniter</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/boostrap.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fileinput.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notify.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fileinput.js"></script>

        <style type="text/css">

            ::selection { background-color: #E13300; color: white; }
            ::-moz-selection { background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #444;
                background-color: transparent;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: normal;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #body {
                margin: 0 15px 0 15px;
            }

            p.footer {
                text-align: right;
                font-size: 11px;
                border-top: 1px solid #D0D0D0;
                line-height: 32px;
                padding: 0 10px 0 10px;
                margin: 20px 0 0 0;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                box-shadow: 0 0 8px #D0D0D0;
            }
        </style>
    </head>
    <body>

        <div id="container">
            <h1>Welcome to CodeIgniter -Ajax Upload!</h1>




            <div class="row">
                <div class="container">
                    <div class="col-xs-12 col-sm-12 col-md-12">


                        <form method="post" id="form-upload" enctype="multipart/form-data" action='<?php echo base_url(); ?>index.php/ajaxupload/upload'>


                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6 col-md-6">

                                    <p>Title <input type="text" name="title" class="form-control" placeholder="Title" /></p>

                                </div>

                                <div class="form-group col-xs-12 col-sm-6 col-md-6">

                                    <p>Description <input type="text" name="description" class="form-control" placeholder="Description" /></p>

                                </div>
                            </div>


                            <div class="form-group">

                                <input id="file-3"  name="userfile" type="file">
                            </div>


                            <div class="progress" style="display:none;">
                                <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                                    20%
                                </div>
                            </div>


                            <div class="form-group">
                                <input  id="upload-btn" type="submit" class="btn btn-success" name = "submit" value="Upload Image" >
                            </div>

                        </form>



                    </div>

                </div>
            </div>

        </div>

        <script>

            $("#file-3").fileinput({
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-primary btn-lg"

            });

            $(function () {
                var inputFile = $('input[name=userfile]');
                var uploadURI = $('#form-upload').attr('action');
                var progressBar = $('#progress-bar');

                $("form#form-upload").submit(function () {
                    event.preventDefault();
                    var fileToUpload = inputFile[0].files[0];
                    // make sure there is file to upload
                    if (fileToUpload != 'undefined') {
                        // provide the form data
                        // that would be sent to sever through ajax
                        var formData = new FormData($(this)[0]);
                        // now upload the file using $.ajax
                        $.ajax({
                            url: uploadURI,
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                if (data.result == '1') {

                                    $.notify({
                                        title: "<strong>Upload Completed</strong> ",
                                        message: "Uploading Cover Image for Listing Completed..!"
                                    }, {
                                        type: 'success'
                                    });

                                } else {
                                    $.notify({
                                        title: "<strong>Upload Completed</strong> ",
                                        message: "Uploading Default Cover Image for Listing Completed..!"
                                    }, {
                                        type: 'warning'
                                    });
                                }
                            },
                            xhr: function () {
                                var xhr = new XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function (event) {
                                    if (event.lengthComputable) {
                                        var percentComplete = Math.round((event.loaded / event.total) * 100);
                                        // console.log(percentComplete);

                                        $('.progress').show();
                                        progressBar.css({width: percentComplete + "%"});
                                        progressBar.text(percentComplete + '%');
                                    }
                                    ;
                                }, false);
                                return xhr;
                            }
                        });
                    }
                });
                $('body').on('change.bs.fileinput', function (e) {
                    $('.progress').hide();
                    progressBar.text("0%");
                    progressBar.css({width: "0%"});
                });
            });

        </script>
    </body>
</html>