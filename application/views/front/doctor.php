<section class="content container-fluid">

        <div class="row container doctor-title">
			<div class="col-xs-12" id="doctor">
				<h4 class="purple page-title text-center"><?= $doctor['name']; ?></h4>
			</div>
		</div>

        <div class="row container doctor-container">
            <div class="col-md-3">
                <?php if($doctor['image']): ?>
                    <img src="<?= $doctor['image']; ?>" alt="" class="w-100">
                <?php else: ?>
                    <img src="/assets/img/doctor-image-small.png" alt="" class="w-100">
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <div class="doctor-description">
                    <?php if($doctor['description']): ?>
                        <?= $doctor['description']; ?>
                    <?php else: ?>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Perspiciatis expedita quidem optio pariatur dolorum impedit, molestias magni repudiandae porro quia possimus in rerum laborum quod distinctio fuga iste culpa ipsum accusantium. Cupiditate praesentium quam sapiente, laudantium nisi repellat necessitatibus sequi est veritatis? Ipsum magni, doloremque reiciendis neque est quas deserunt voluptate tenetur. Esse quidem vel praesentium? Ex repudiandae voluptate nulla aut, earum eius ut temporibus adipisci asperiores vero dolores quaerat amet eligendi tempore pariatur unde, est quod velit dolorem neque ipsum numquam? Eveniet assumenda consequatur commodi nam deserunt suscipit saepe, repellendus porro eos, molestias labore facilis ipsam eum! Unde, hic.</p>
                    <?php endif; ?>
                </div>
                
            </div>
            <div class="col-md-3">
                <?php foreach($hospital_data as $hospital): ?>
                    <?php 
                        $schedules = json_decode($hospital->schedule->jadwal, true);
                    ?>
                    <?php if($schedules): ?>

                        <?php $grouped_schedule = group_array("poli", $schedules); ?>
                        <?php foreach($grouped_schedule as $poli => $schedules): ?>
                            <div class="mb-2" style="margin-bottom: 2rem;">
                                
                                <h4 class="purple page-title text-center" style="margin-top: 0; margin-bottom: 0;"><?= $poli; ?></h5>
                                <h4 class="purple page-title text-center" style="margin-top: 0;"><?= $hospital->hospital ?></h5>
                                <table class="table schedule-table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <td width="30%">
                                                Day
                                            </td>
                                            <td>
                                                Time
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($schedules as $schedule): ?>
                                            <tr>
                                                <td><?= day_maker($schedule['weekday']); ?></td>
                                                <td>
                                                    <span><?= time_maker($schedule['start_hour'], $schedule['start_minute']) ?> - <?= time_maker($schedule['end_hour'], $schedule['end_minute']) ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-default btn-circle" value="<?= $hospital->pid ?>" onclick="checkS(this.value,'<?= $hospital->rsid ?>','<?= $hospital->hospital ?>')">Get Appointment</button>
                            </div>

                        <?php endforeach; ?> 

                    <?php endif; ?>

                <?php endforeach; ?>
                
            </div>
        </div>
	
</section>