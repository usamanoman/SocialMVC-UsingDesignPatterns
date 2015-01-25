$(function(){
			$("#main-menu  li,#sub-menu,.sub-menu-list,.sub-menu-list li").hover(function(){
				$("#sub-menu").stop();
				$("#sub-menu").slideDown();
			},
			function()
			{
				$("#sub-menu").stop();
				$("#sub-menu").slideUp();	
			});



			$(".tag-line").hide();

			function show_tagline(show_id){
				$(".tag-line:eq("+show_id+")").fadeIn();
				
			}

			var tagline=0;
			show_tagline(tagline);

			$(".tagline-previous").click(function(){
				if(tagline>0){
					tagline--;
					$(".tag-line").hide();
					show_tagline(tagline);
				}
			});
			

			$(".tagline-next").click(function(){
				if(tagline<2){
					tagline++;
					$(".tag-line").hide();
					show_tagline(tagline);
				}
			});




		});