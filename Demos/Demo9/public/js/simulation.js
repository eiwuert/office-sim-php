(function ($) {

	$(function()
	{
	 	$('#simulate').click(function(){
	 		runSimulation();
		});
	});

	var runSimulation = function()
	{
		$.get("/demos/demo9/public/simulate", function(data)
		{
			$('#simulation').html(data);
		});
	};

})(jQuery); 

