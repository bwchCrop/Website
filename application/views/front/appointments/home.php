<div class="columns is-centered is-vcentered">
  <div class="column is-full-mobile is-three-fifths-tablet is-two-fifths-desktop">
    <div class="card">
      <?php if($peid != 0): ?>
        <div class="card-content">
          <div class="has-text-centered">
            <?php if($this->session->flashdata('warning')): ?>
                <article class="message is-warning">
                  <div class="message-body">
                    <?= $this->session->flashdata('warning'); ?>
                  </div>
                </article>
            <?php endif; ?>
            <h1 class="subtitle is-size-6">Konfirmasikan kehadiran anda dengan mengklik tombol berikut:</h1>
            <form id="patient-form" action="/patient-confirmation/attendance" method="POST">
              <div class="columns is-centered">
                <!-- <button class="button">Tidak Hadir</button> -->
                <input type="hidden" name="token" id="token">
                <input type="hidden" name="peid" id="peid" value="<?= $peid; ?>">
                <input type="hidden" name="confirmation" id="confirmation">
              </div>  
            </form>
            <div class="columns is-centered mt-4">
              <button 
                class="button is-danger g-recaptcha mr-2"
                data-sitekey="6LdInZAlAAAAAAE5NesIRpih5i0SfgXCe_FYZD35"
                data-callback="onSubmitCancel"
                data-action="submit">Batal</button>
              <button 
                class="button is-primary g-recaptcha"
                data-sitekey="6LdInZAlAAAAAAE5NesIRpih5i0SfgXCe_FYZD35"
                data-callback="onSubmit"
                data-action="submit">Hadir</button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      
    </div>
  </div>
</div>