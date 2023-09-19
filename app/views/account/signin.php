<?php $this->setSiteTitle('Sign in'); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>


<?php $this->start('body'); ?>

<div id="signInPage">
    <div class="modal modal-signin position-static d-block  py-5" tabindex="-1" role="dialog" id="modalSignin">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h1 class="fw-bold mb-0 fs-2">Sign in</h1>
                </div>

                <div class="modal-body p-5 pt-0">
                    <form class="" action="<?= PROOT ?>account/signin" method="post">
                        <div class="form-floating mb-3 col" style="padding-left: 0">
                            <input type="text" class="form-control" id="username"
                                   placeholder="Ex: John. john@gmail.com"
                                   name="username">
                            <label for="first_name">Username or e-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-3" id="floatingPassword"
                                   placeholder="Password" name="password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input text-center" id="checkbox" name="rememberMe">
                            <label class="form-check-label" for="checkbox">Remember me</label>
                        </div>
                        <div><?= $this->displayErrors ?></div>
                        <button class="w-100 mb-2 btn btn-lg rounded-3 btn-outline-light" type="submit"
                                style="background: #ffc720;">Sign in
                        </button>
                    </form>
                    <div class="text-center">
                        <a href="<?= PROOT ?>account/signup" class="text-decoration-none">Don't have an account? Sign up
                            here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->end(); ?>
