	$('.input-group.mg-check-in').datepicker({
		format: 'yyyy-mm-dd',
		startDate: "dateToday",
		autoclose: true,
	});

	$('.input-group.mg-check-in').on('hide', function (e) {


		if (e.dates.length) {
			var strDate = e.date;
			strDate.setDate(strDate.getDate() + 1);

			// $('.mg-check-out').datepicker('clearDates');
			$('.mg-check-out').datepicker('setStartDate', strDate);
		}

		$(e.currentTarget).removeClass('focus');
		
	});

	$('.input-group.mg-check-in').on('show', function (e) {

		$(e.currentTarget).addClass('focus');
		
	});

