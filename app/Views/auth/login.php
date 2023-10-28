                    <?= $this->extend('auth/templates/index.php'); ?>
                    <?= $this->section('main') ?>
                    <?= helper('website'); ?>
                    <div class="p-3">
                        <div class="text-center">
                            <img src="<?= base_url(); ?>/assets/images/<?= web()->logo; ?>" alt="wrapkit" width="50" height="50">
                        </div>
                        <h2 class="mt-3 text-center">Selamat Datang</h2>
                        <p class="text-center">Masukkan Username dan Password Anda.</p>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form class="mt-4" method="post" action="<?= route_to('login') ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if ($config->validFields === ['email']): ?>
                                    <div class="form-group">
                                        <label class="text-dark" for="email"><?=lang('Auth.email')?></label>
                                        <input class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="email" id="email" type="text"
                                            placeholder="<?=lang('Auth.email')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="form-group">
                                        <label class="text-dark" for="login"><?=lang('Auth.emailOrUsername')?></label>
                                        <input class="form-control <?php if(session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" id="login" type="text"
                                            placeholder="<?=lang('Auth.emailOrUsername')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.login') ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="password"><?=lang('Auth.password')?></label>
                                        <input class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" id="password" type="password"
                                            placeholder="<?=lang('Auth.password')?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($config->allowRemembering): ?>
                                <div class="col-lg-12">
                                    <fieldset class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" <?php if(old('remember')) : ?> checked <?php endif ?>> <?=lang('Auth.rememberMe')?>
                                        </label>
                                    </fieldset>
                                </div>

                                <?php endif; ?>
                                
                                <div class="col-lg-12 text-center">
                                    <button type="submit" name="kirim" class="btn btn-block btn-dark">Sign In</button>
                                </div>

                                <?php if ($config->allowRegistration) : ?>
                                <div class="col-lg-12 text-center mt-2">
                                    Don't have an account? <a href="<?= route_to('register') ?>" class="text-danger">Sign Up</a>
                                </div>
                                <?php endif; ?>

                                <?php if ($config->activeResetter) : ?>
                                <div class="col-lg-12 text-center mt-2">
                                    <?=lang('Auth.forgotYourPassword')?> <a href="<?= route_to('forgot') ?>" class="text-danger">Reset</a>
                                </div>
                                <?php endif; ?>

                            </div>
                        </form>
                    </div>
                    <?= $this->endSection(); ?>