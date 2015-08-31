<div id="activation-success-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="activation-success-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="activation-success-label">Activare reușită!</h3>
    </div>

    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <p>Contul dvs. a fost activat cu succes. De acum puteți să deschideți petiții!</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#activation-success-modal').modal('show');
$('#activation-success-modal').on('hidden', function() {window.location.replace("<?php echo base_url();?>");});
</script>
