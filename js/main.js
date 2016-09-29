(function(window) {
	'use strict';
	var decoder = $('#qr-canvas'),
		sl = $('.scanner-laser'),
		pl = $('#play'),
		si = $('#scanned-img'),
		sQ = $('#scanned-QR'),
		sv = $('#save'),
		sp = $('#stop'),
		spAll = $('#stopAll'),
		co = $('#contrast'),
		cov = $('#contrast-value'),
		zo = $('#zoom'),
		zov = $('#zoom-value'),
		br = $('#brightness'),
		brv = $('#brightness-value'),
		tr = $('#threshold'),
		trv = $('#threshold-value'),
		sh = $('#sharpness'),
		shv = $('#sharpness-value'),
		gr = $('#grayscale'),
		grv = $('#grayscale-value');
		$('[data-toggle="tooltip"]').tooltip();
	sl.css('opacity', .5);
	pl.click(function() {
		if (typeof decoder.data().plugin_WebCodeCam == "undefined") {
			decoder.WebCodeCam({
				autoBrightnessValue: 120,
				beep:"sound/beep.mp3",
				videoSource: {
					id: $('select#cameraId').val(),
					maxWidth: 640,
					maxHeight: 480
				},
				// zoom: -1,
				// autoBrightnessValue: false,
				resultFunction: function(text, imgSrc) {
					$('#barcodekode').val(text);
				},
				getUserMediaError: function() {
					alert('Sorry, the browser you are using doesn\'t support getUserMedia');
				},
				cameraError: function(error) {
					var p, message = 'Error detected with the following parameters:\n';
					for (p in error) {
						message += p + ': ' + error[p] + '\n';
					}
					alert(message);
				}
			});
		} else {
			sv.removeClass('disabled');
			sQ.text('Scanning ...');
			decoder.data().plugin_WebCodeCam.cameraPlay();
		}
	});

	function gotSources(sourceInfos) {
		for (var i = 0; i !== sourceInfos.length; ++i) {
			var sourceInfo = sourceInfos[i];
			var option = document.createElement('option');
			option.value = sourceInfo.id;
			if (sourceInfo.kind === 'video') {
				var face = sourceInfo.facing == '' ? 'unknown' : sourceInfo.facing;
				// option.text = sourceInfo.label || 'camera ' + (videoSelect.length + 1) + ' (facing: ' + face + ')';
				// videoSelect.appendChild(option);
			}
		}
	}
	if (typeof MediaStreamTrack.getSources !== 'undefined') {
		var videoSelect = document.querySelector('select#cameraId');
		$(videoSelect).change(function(event) {
			if (typeof decoder.data().plugin_WebCodeCam !== "undefined") {
				decoder.data().plugin_WebCodeCam.options.videoSource.id = $(this).val();
				decoder.data().plugin_WebCodeCam.cameraStop();
				decoder.data().plugin_WebCodeCam.cameraPlay(false);
			}
		});
		MediaStreamTrack.getSources(gotSources);
	} else {
		document.querySelector('select#cameraId').remove();
	}
}).call(window.Page = window.Page || {});