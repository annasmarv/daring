<?php
/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(0);
?>
<nav>
	<ul class="pagination pager">
		<li style="width:50%" class="<?= $pager->hasPrevious() ? '' : 'disabled' ?>">
			<a class="btn btn-outline-primary btn-block" href="<?= $pager->getPrevious() ?? '#' ?>" aria-label="<?= lang('Pager.previous') ?>">
				<span aria-hidden="true"><b>Sebelumnya</b></span>
			</a>
		</li>
		<li>&nbsp;</li>
		<li>&nbsp;</li>
		<li>&nbsp;</li>
		<?php if ($pager->hasNext()) { ?>
		<li style="width:50%" class="page-item">
			<a class="text-white btn btn-primary btn-block" href="<?= $pager->getnext() ?? '#' ?>" aria-label="<?= lang('Pager.next') ?>">
				<span aria-hidden="true"><b>Selanjutnya</b></span>
			</a>
		</li>
		<?php }else{ ?>
		<li style="width:50%" class="page-item">
			<a class="text-white btn btn-danger btn-block" data-toggle="modal" data-target="#bs-example-modal-sm">
				<span aria-hidden="true"><b>Selesai</b></span>
			</a>
		</li>
		<?php } ?>
	</ul>
</nav>
