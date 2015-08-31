<div id="require-authl-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="require-auth-label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="require-authl-label">Autentificare necesară</h3>
    </div>

    <div class="modal-body">
        <div class="row-fluid">
            <div class="span12">
                <p>Pentru a iniția o petiție, trebuie să fiți autentificat. <a href="<?php echo base_url();?>register">Înregistrați-vă</a> sau <a href="#login-modal" data-toggle="modal" id="login-box" style="font-weight: normal;">autentificați-vă</a>.</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#require-auth-modal').modal('show');
$('#require-auth-modal').on('hidden', function() {window.location.replace("<?php echo base_url();?>");});
</script>