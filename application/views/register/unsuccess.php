<div id="activation-failure-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="activation-failure-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="activation-failure-label">Activare nereușită</h3>
    </div>

    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <p>Link-ul de activare nu există sau a expirat.</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#activation-failure-modal').modal('show');
$('#activation-failure-modal').on('hidden', function() {window.location.replace("<?php echo base_url();?>");});
</script>
