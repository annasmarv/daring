			<?= $this->extend('templates/index'); ?>
			<?= $this->section('content'); ?>
			<div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card border-primary">
                            <?php  
                            foreach ($modul as $x) { ?>
                            <div class="card-body">
                                <h3 class="card-title"><?= $x['title'];?></h3>
                                <h6 class="card-subtitle"><b><?= $x['subject_name'];?></b> <?= $x['fullname'];?></h6>
                                <?php if ($x['youtube'] !== "") { ?>
                                    <div class="video-container-yt"><iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $x['youtube'] ?>" frameborder="0" allowfullscreen></iframe></div>
                                <?php } ?>
                                <p class="card-text"><?= $x['content']; ?></p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
			<?= $this->endSection('content'); ?>