<div id="app">
    <section class="content container-fluid">
        <div class="row container schedule">
            <div class="col-xs-12 header titleS" align="center">
                <h1 class="italic purple">FIND DOCTOR'S</h1>
            </div>

            <find-doctor :profile_display="<?= _ENABLE_PROFILE_DOCTOR ? 1 : 0; ?>" api_url="<?= API_URL; ?>"></find-doctor>
        </div>
    </section>
</div>
