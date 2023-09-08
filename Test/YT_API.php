add_shortcode('youtube_api_test', function(){
	$vID = get_field('video_id');
	ob_start();
	?>
	<div id="player"></div>

    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var c_player;
      function onYouTubeIframeAPIReady() {
        c_player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: '<?= $vID ?>',
          playerVars: {
            'playsinline': 1
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
		  
		  document.querySelectorAll('.btnSeek').forEach($e => $e.addEventListener('click', function(){
				const _t = this.dataset.seek
				c_player.seekTo(_t)
			}))
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
//         event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
	<?php

	return ob_get_clean();
});