<div id="forgotten-pass-modal" class="modal show" tabindex="-1" role="dialog" aria-labelledby="forgotten-pass-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="forgotten-pass-label">Recuperare parolă</h3>
    </div>

    <div class="modal-body">
            <div class="alert alert-block alert-error fade in" id="popup">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <h4 class="alert-heading" id = "completion-status"></h4>
                    <?php $erori = 0;                   
                    $ec = form_error('email');  if ($ec != ""){$erori=1; echo $ec;}                 
                    $ec = form_error('varsta');  if ($ec != ""){$erori=1; echo $ec;}
                    ?>                 
                    <script type="text/javascript">
                    <?php 
                        if($erori === 0) {
                            echo "$('.alert').hide();";
                        }
                        else {
                            echo "$('.alert').show();";
                        }
                    ?>
                    </script>
                </div>
            <form action="<?php echo base_url();?>login/recuperare_parola" method="post" class="form-horizontal">
                
                <fieldset>                          
                    <div class="controls">
                        <label style="padding-right:5px;" class="control-label" for="inputEmail">Email</label>
                        <input type="email" name="email" value="<?php echo set_value('email'); ?>" id="inputEmail" title="Introduceți e-mailul dvs. Exemplu: nume@domeniu.com" data-placement="right">
                    </div>
                    <div class="controls input-append date" data-date="01-01-1990" data-date-format="dd.mm.yyyy">
                        <label style="padding-right:5px;" class="control-label" for="inputAge">Data naşterii</label>
                        <input type="text" name="varsta" value="<?php echo set_value('varsta'); ?>" id="inputAge" data-placement="right" readonly="readonly">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                    </div>
                    <script type="text/javascript">
                        document.getElementById("completion-status").innerHTML = "Nu ați completat datele necesare.";
                        <?php if($erori === 0) {
                                echo "$('.alert').hide();";
                        }
                            else {
                                echo "$('.alert').show();";
                            }
                        ?>

                        $('.date').datepicker()
                    </script>                
                                                                                
                    <div align="center">
                        <button type="submit" class="btn btn-large btn-primary controls" id="trimite">Trimite</button>
                    </div>
                </fieldset>
            </form>
    </div>
</div>
