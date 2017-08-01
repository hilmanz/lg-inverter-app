<footer class="footer-1 bg-primary">
                <div class="container">

                    <div class="row">
                        <div class="col-sm-12 text-left">
                            <span class="sub">&copy; 2015 | Copyright LG Indonesia</span>
                        </div>
                    </div>
                </div>
                <!--end of container-->
                <a class="btn btn-sm fade-half back-to-top inner-link" href="#top">Top</a>
            </footer>
        </div>

        <!-- <script src="<?=base_url()?>assets/jsjquery.min.js"></script> -->
        <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/jsflickr.js"></script> -->
        <script src="<?=base_url()?>assets/js/flexslider.min.js"></script>
        <script src="<?=base_url()?>assets/js/lightbox.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/jsmasonry.min.js"></script> -->
        <!-- <script src="<?=base_url()?>assets/jstwitterfetcher.min.js"></script> -->
        <!-- <script src="<?=base_url()?>assets/jsspectragram.min.js"></script> -->
        <script src="<?=base_url()?>assets/js/ytplayer.min.js"></script>
        <!-- <script src="<?=base_url()?>assets/jscountdown.min.js"></script> -->

        <script src="<?=base_url()?>assets/js/smooth-scroll.min.js"></script>
        <script src="<?=base_url()?>assets/js/parallax.js"></script>
        <script src="<?=base_url()?>assets/js/scripts.js"></script>
    </body>
</html>
<!--
<script>
		var basedomain="<?=base_url()?>";
		//var deadline = '2016-05-16 14:55:00';
		var deadline = '<?=$event_time;?>';
				console.log(deadline);
				
				
			
		$(function(){
			var note = $('#note'),
				ts = endtime = deadline;
				newYear = false;
			console.log(ts);
				
			$('#countdown').countdown({
				timestamp   : ts,
				callback    : function(days, hours, minutes, seconds){
					var message = "";     
					note.html(message);
				}
			});
		});

	
		function getTimeRemaining(endtime){
		  var t = Date.parse(endtime) - Date.parse(new Date());
		  var seconds = Math.floor( (t/1000) % 60 );
		  var minutes = Math.floor( (t/1000/60) % 60 );
		  var hours = Math.floor( (t/(1000*60*60)) % 24 );
		  var days = Math.floor( t/(1000*60*60*24) );
		  return {
			'total': t,
			'days': days,
			'hours': hours,
			'minutes': minutes,
			'seconds': seconds
		  };
		}
		
		function initializeClock(id, endtime){
		  var clock = document.getElementById(id);
		  var hoursSpan = document.getElementById('hours');
		  var minutesSpan = document.getElementById('minutes');
		  var secondsSpan = document.getElementById('seconds');
		  var timeinterval = setInterval(function(){
		  var t = getTimeRemaining(endtime);
			/*
			clock.innerHTML = 'days: ' + t.days + '<br>' +
							  'hours: '+ t.hours + '<br>' +
							  'minutes: ' + t.minutes + '<br>' +
							  'seconds: ' + t.seconds ;
			
						
			hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
			minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
			secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
			*/
			if(t.total<=0){
				//alert("endtime");
				window.location = basedomain;
			  clearInterval(timeinterval);
			}
			/*TimeNow();*/
			
		  },1000);
		}
		
		initializeClock('clockdiv', deadline);
		
	
		
</script>
	-->