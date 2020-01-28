<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
	<?php if($this->session->flashdata('success')){ ?>
    Swal.fire(
        'Success!',
        '<?php echo $this->session->flashdata("success"); ?>',
        'success'
    );
	<?php }else if($this->session->flashdata('error')){  ?>
    Swal.fire(
        'Error!',
        '<?php echo $this->session->flashdata("error"); ?>',
        'error'
    );
	<?php }else if($this->session->flashdata('warning')){  ?>
    Swal.fire(
        'Warning!',
        '<?php echo $this->session->flashdata("warning"); ?>',
        'warning'
    );
	<?php }else if($this->session->flashdata('info')){  ?>
    Swal.fire(
        'Information!',
        '<?php echo $this->session->flashdata("info"); ?>',
        'info'
    );
	<?php } ?>
</script>
