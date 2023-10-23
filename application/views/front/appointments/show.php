<?php if($this->session->flashdata('success')): ?>
    <article class="message is-success">
        <div class="message-body">
            <?= $this->session->flashdata('success'); ?>
        </div>
    </article>
<?php endif; ?>
<div class="columns is-centered">
    <div class="column is-full-mobile is-one-fifths-tablet is-one-third-desktop">
        <div class="card has-background-primary">
            <header class="card-header">
                <p class="card-header-title has-text-white">
                    <?php if($appointmentStatus['rmNumber'] == 'OTC' || $appointmentStatus['rmNumber'] == null ): ?>
			Nomor Antrian Admission
		    <?php else: ?>
			Nomor Antrian Registrasi
		    <?php endif; ?>
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <h1 class="has-text-white is-size-1 has-text-centered"><?= $appointmentStatus['antrianNumber']; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="column is-full-mobile is-three-fifths-tablet is-three-fifths-desktop">
        <table class="table is-fullwidth is-hoverable no-border">
            <tbody>
                <tr>
                    <th>Nama Pasien</th>
                    <td><?= $appointmentStatus['patientName']; ?></td>
                </tr>
                <tr>
                    <th>Nama Dokter</th>
                    <td><?= $appointmentStatus['doctorName']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Berobat</th>
                    <td><?= $appointmentStatus['appointmentDate']; ?></td>
                </tr>
                <tr>
                    <th>Nomor RM</th>
                    <td><?= $appointmentStatus['rmNumber'] !== 'null' ? $appointmentStatus['rmNumber'] : '-'; ?></td>
                </tr>
                <tr>
                    <th>Kode Booking</th>
                    <td><?= $appointmentStatus['bookingCode'] !== 'null' ? $appointmentStatus['bookingCode'] : '-'; ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?= $appointmentStatus['branch'] !== 'null' ? $appointmentStatus['branch'] : '-'; ?></td>
                </tr>
                <tr>
                    <th>Status Perjanjian</th>
                    <td>
                    <?php if($appointmentStatus['statusAppointment'] == "Proses perjanjian"): ?>
                        <span class="tag is-success is-medium"><?= $appointmentStatus['statusAppointment']; ?></span>
                    <?php elseif($appointmentStatus['statusAppointment'] == "Sudah Registrasi"): ?>
                        <span class="tag is-info is-medium"><?= $appointmentStatus['statusAppointment']; ?></span>
                    <?php else: ?>
                        <span class="tag is-primary is-medium"><?= $appointmentStatus['statusAppointment']; ?></span>
                    <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Status Kehadiran</th>
                    <td>
                        <?php if($appointmentStatus['confirmAttendance'] == "Hadir"): ?>
                            <span class="tag is-success is-medium"><?= $appointmentStatus['confirmAttendance']; ?></span>
                        <?php elseif($appointmentStatus['confirmAttendance'] == "null"): ?>
                            <span class="tag is-info is-medium">"-"</span>
                        <?php else: ?>
                            <span class="tag is-primary is-medium"><?= $appointmentStatus['confirmAttendance'] ?? "-"; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
