(function($){

	var marketingCumulative=null;
	var marketingMonthly=null;
	var referalHitMiss=null;
	var advertisingHitMiss=null;
	var InPersonHitMiss=null;
	var marketingDelaysCumulative=null;
	var marketingDelaysMonthly=null;

	$( document ).ready(function() {
	    $('#simulate').on('click',function(e){
	    	e.preventDefault();
	    	runSimulation();
	    });

	});

	function runSimulation()
	{
		$.getJSON("/demos/demo10/simulate.php", function(data)
		{
			
			graphMarketingCumulative(data);

			graphMarketingMonthly(data);

			graphMarketingHitMiss(data);

			graphMarketingDelaysCumulative(data);

			graphMarketingDelaysMonthly(data.Delays.Marketing.monthly);

		});
	}

	function graphMarketingHitMiss(data)
	{

		if(referalHitMiss!==null){
	        referalHitMiss.destroy();
	    }

	    if(advertisingHitMiss!==null){
	        advertisingHitMiss.destroy();
	    }

	    if(InPersonHitMiss!==null){
	        InPersonHitMiss.destroy();
	    }

	    referalHitMiss = new Chart($('#referalHitMiss'), {
		    type: 'pie',
		    data: {
			    labels: data.Marketing.hitmiss.Referral.labels,
			    datasets: data.Marketing.hitmiss.Referral.datasets
			}
		});

		advertisingHitMiss = new Chart($('#advertisingHitMiss'), {
		    type: 'pie',
		    data: {
			    labels: data.Marketing.hitmiss.Advertising.labels,
			    datasets: data.Marketing.hitmiss.Advertising.datasets
			}
		});

		InPersonHitMiss = new Chart($('#InPersonHitMiss'), {
		    type: 'pie',
		    data: {
			    labels: data.Marketing.hitmiss.InPerson.labels,
			    datasets: data.Marketing.hitmiss.InPerson.datasets
			}
		});

	}

	function graphMarketingCumulative(data)
	{

		if(marketingCumulative!==null){
	        marketingCumulative.destroy();
	    }

		marketingCumulative = new Chart($('#marketingCumulative'), {
		    type: 'pie',
		    data: {
			    labels: data.Marketing.cumulative.labels,
			    datasets: data.Marketing.cumulative.datasets
			}
		});

	}


	function graphMarketingDelaysCumulative(data)
	{

		if(marketingDelaysCumulative!==null){
	        marketingDelaysCumulative.destroy();
	    }

		marketingDelaysCumulative = new Chart($('#marketingDelaysCumulative'), {
		    type: 'pie',
		    data: {
			    labels: data.Delays.Marketing.cumulative.frequency.labels,
			    datasets: data.Delays.Marketing.cumulative.frequency.datasets
			}
		});

	}

	function graphMarketingDelaysMonthly(data)
	{

		if(marketingDelaysMonthly!==null){
	        marketingDelaysMonthly.destroy();
	    }

		marketingDelaysMonthly = new Chart($('#marketingDelaysMonthly'), {
		    type: 'bar',
		    data: {
			    labels: data.labels,
			    datasets: data.datasets
			}
			
		});

	}

	


	/*
	options: {
				scales: {
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 15
                            }
                        }]
                }
			}
	*/
	function graphMarketingMonthly(data)
	{

		if(marketingMonthly!==null){
	        marketingMonthly.destroy();
	    }

		marketingMonthly = new Chart($('#marketingMonthly'), {
		    type: 'bar',
		    data: {
			    labels: data.Marketing.monthly.labels,
			    datasets: data.Marketing.monthly.datasets
			}
			
		});

	}

})(jQuery);