<div id="register-success-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="register-success-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="register-success-label">Înregistrare reușită</h3>
    </div>

    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <p>Contul a fost creat. Verifică adresa de e-mail pentru validarea acestuia.</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#register-success-modal').modal('show');
$('#register-success-modal').on('hidden', function() {window.location.replace("<?php echo base_url();?>");});
</script>
