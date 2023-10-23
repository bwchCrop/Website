<?php if($this->session->flashdata('success')): ?>
    <article class="message is-success">
        <div class="message-body">
            <?= $this->session->flashdata('success'); ?>
        </div>
    </article>
<?php endif; ?>
<?php if($this->session->flashdata('warning')): ?>
    <article class="message is-warning">
        <div class="message-body">
            <?= $this->session->flashdata('warning'); ?>
        </div>
    </article>
<?php endif; ?>
<div class="columns is-centered">
    <div class="column is-full-mobile is-one-fifths-tablet is-one-third-desktop">
        <form action="<?= base_url('middleware-appointment/do_login'); ?>" method="post">
        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" name="username" type="text" placeholder="Username">
            </div>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" name="password" type="password" placeholder="Password">
            </div>
        </div>
        <button class="button is-fullwidth">Login</button>
        </form>
    </div>
</div>  