$(document).on("ready", function(){
	
	// Code jquery pour cacher le titre et le cartouche (= le 1er div juste après le titre) présents sur la vidéo pendant sa lecture
	var iframe = $('#player1')[0],
	player = $f(iframe),
	status = $('.status');

	// When the player is ready, add listeners for pause, finish, and playProgress
	player.addEvent('ready', function() {
		status.text('ready');
		
		player.addEvent('pause', onPause);
		player.addEvent('finish', onFinish);
		player.addEvent('playProgress', onPlayProgress);
	});
	
	// Call the API when a button is pressed
	$('button').bind('click', function() {
		player.api($(this).text().toLowerCase());
	});
	
	function onPause(id) {
		//status.text('paused');
		$('#nomCrea').css({"visibility":"visible"}); // pour (ré)afficher le titre
		$('#nomCrea + div').css({"visibility":"visible"}); // pour (ré)afficher le cartouche
		$('.pictoPlayVideo').css({"visibility":"visible"}); // pour (re)cacher le cartouche
	}
	
	function onFinish(id) {
		//status.text('finished');
		$('#nomCrea').css({"visibility":"visible"}); // pour (ré)afficher le titre
		$('#nomCrea + div').css({"visibility":"visible"}); // pour (ré)afficher le cartouche
		$('.pictoPlayVideo').css({"visibility":"visible"}); // pour (re)cacher le cartouche
	}
	
	function onPlayProgress(data, id) {
		//status.text(data.seconds + 's played');
		$('#nomCrea').css({"visibility":"hidden"}); // pour (re)cacher le titre
		$('#nomCrea + div').css({"visibility":"hidden"}); // pour (re)cacher le cartouche
		$('.pictoPlayVideo').css({"visibility":"hidden"}); // pour (re)cacher le cartouche
	}
	
});