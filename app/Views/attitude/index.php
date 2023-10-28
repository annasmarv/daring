            <?= $this->extend('templates/index'); ?>
            <?= $this->section('content'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background:transparent!important;">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <form method="get" action="<?= base_url(); ?>/learn/classes">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" placeholder="..." value="<?= $keyword; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success btn-round" type="submit"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-columns">
                                    <?php foreach ($classes as $class): ?>
                                        <a href="<?= base_url(); ?>/learn/classes/<?= $class['id']; ?>/<?= $class['class_group_id']; ?>/<?= $class['subject_id']; ?>" style="color:black">
                                            <div class="card card-s" style="color: black;">
                                                <div class="bg-warning" style="background-image: url('<?= base_url(); ?>/img/cr.svg')!important;background-size: 50px;background-position: center;background-repeat: no-repeat;height: 100px;">
                                                </div>
                                                <div class="px-3 py-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <p class="mb-0">
                                                                <b><?= $class['subject_name']; ?> </b> - <?= $class['class_group_name']; ?>
                                                            </p>
                                                            <p class="card-text">
                                                                <small class="text-muted"><?= $class['fullname']; ?></small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach ?>
                                </div>
                                <?= $pager->links('pager', 'default_page'); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?= $this->endSection();  ?>