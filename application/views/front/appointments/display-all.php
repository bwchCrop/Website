<?php if($this->session->flashdata('success')): ?>
    <article class="message is-success">
        <div class="message-body">
            <?= $this->session->flashdata('success'); ?>
        </div>
    </article>
<?php endif; ?>
<div class="columns is-centered">
    <div class="column">
    <table id="example" class="table is-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>No. HP Pasien</th>
                <th>Asal Channel</th>
                <th>PEID</th>
                <th>Nama Dokter</th>
                <th>Tanggal Berobat</th>
                <th>Nomor RM</th>
                <th>Kode Booking</th>
                <th>Branch</th>
                <th>Status Perjanjian</th>
                <th>Status Kehadiran</th>
                <th>Status Notifikasi</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($appointments)): ?>
                <?php foreach($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['patientName']; ?></td>
                        <td><?= $appointment['whatsappNumber']; ?></td>
                        <td><?= $appointment['channel']; ?></td>
                        <td><?= $appointment['peid']; ?></td>
                        <td><?= $appointment['doctorName']; ?></td>
                        <td><?= $appointment['appointmentDate']; ?></td>
                        <td><?= $appointment['rmNumber'] !== 'null' ? $appointment['rmNumber'] : '-'; ?></td>
                        <td><?= $appointment['bookingCode'] !== 'null' ? $appointment['bookingCode'] : '-'; ?></td>
                        <td><?= $appointment['branch'] !== 'null' ? $appointment['branch'] : '-'; ?></td>
                        <td>
                            <?php if($appointment['statusAppointment'] == "Proses perjanjian"): ?>
                                <span class="tag is-success is-medium"><?= $appointment['statusAppointment']; ?></span>
                            <?php elseif($appointment['statusAppointment'] == "Sudah Registrasi"): ?>
                                <span class="tag is-info is-medium"><?= $appointment['statusAppointment']; ?></span>
                            <?php else: ?>
                                <span class="tag is-primary is-medium"><?= $appointment['statusAppointment']; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($appointment['confirmAttendance'] == "Hadir"): ?>
                                <span class="tag is-success is-medium"><?= $appointment['confirmAttendance']; ?></span>
                            <?php elseif($appointment['confirmAttendance'] == "null"): ?>
                                <span class="tag is-info is-medium">-</span>
                            <?php else: ?>
                                <span class="tag is-primary is-medium"><?= $appointment['confirmAttendance'] ?? "-"; ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= $appointment['notificationStatus'] ?? '-'; ?></td>
                        <td><?= $appointment['creationDatetime'] ?? '-'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </tbody>
        <tfoot>
            <tr>
                <th>Nama Pasien</th>
                <th>No. HP Pasien</th>
                <th>Asal Channel</th>
                <th>PEID</th>
                <th>Nama Dokter</th>
                <th>Tanggal Berobat</th>
                <th>Nomor RM</th>
                <th>Kode Booking</th>
                <th>Branch</th>
                <th>Status Perjanjian</th>
                <th>Status Kehadiran</th>
                <th>Status Notifikasi</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </tfoot>
    </table>
    </div>
</div>