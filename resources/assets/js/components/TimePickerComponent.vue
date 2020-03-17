<template>
<div class="booking-content">
    <h5>Select your date of booking.</h5>
    <div id="date-booking" class="d-flex justify-content-between align-items-start">
    	<p>Date:</p>
        <input type="text" class="datepicker" style= "margin:30px" v-on:change="change()">
    </div>
	<div class="list-group" v-if="date != null">
    <label>Time</label>
    	<div class="time-slots row">
    		<div class="col-4" v-for="(timeslot, index) in timeslots">
    			<button type="button" class="btn btn-primary" v-on:click="chosenTime(index)" :disabled="timeslot.disable">{{timeslot.time}}</button>
    		</div>
    	</div>	
	</div>
</div>
</template>

<script>
  export default {
  	props: ['propService', 'propStaff', 'propAppointments'], //fixed
    data: function(){
      return {
      	date: null,
		service: null,
		staff: null,
		appointments: null,
		timeslots: [
			{ time: '09:00:00', disable: false},
			{ time: '10:00:00', disable: false},
			{ time: '11:00:00', disable: false},
			{ time: '12:00:00', disable: false},
			{ time: '13:00:00', disable: false},
			{ time: '14:00:00', disable: false},
			{ time: '15:00:00', disable: false},
			{ time: '16:00:00', disable: false},
			{ time: '17:00:00', disable: false},
			{ time: '18:00:00', disable: false},
			{ time: '19:00:00', disable: false},
            { time: '20:00:00', disable: false}
		],
		picked: null
      };
    },
    mounted() {
    	this.service = JSON.parse(this.propService);
    	this.staff = JSON.parse(this.propStaff);
    	this.appointments = JSON.parse(this.propAppointments);
    	//JSON.parse (changes from string to object). because we cannot use the string and manipulate it
    	let self = this;
    	//use self as this because we are using jQuery. jQuery has their own definition of this. 

    	$('.datepicker').on('changeDate', function() {
    		self.date = $('.datepicker').val();
    		self.dateChange();
		});
			//used on mounted because every time it is refreshed, it will be initialized
			//the datepicker value in the second line, is when the date is picked (aka changeDate is provoked), the new date is stored into self.date
			//the last line is calling the function dateChange()
			//the second line is putting the new date into the date variable on the top.
    },
    methods: {
        resetTime: function() {
            let self = this;

            _.forEach(this.timeslots, function(timeslot, key) {
              self.timeslots[key].disable = false;
            });
        },
    	dateChange: function(){
    		axios.get(`/services/${this.service.id}/staffs/${this.staff.id}/appointments?date=${this.date}`)
	    	.then(({ data }) => {
	    		this.appointments = data;
	    		this.loadAppointments();
	    	}, (error) => {
	    		console.log(error);
	  		});	
    	},
    	loadAppointments: function() {
    		if(!this.appointments.length) {
              this.resetTime();
    		  return;
    		}
    		
    		let self = this;

    		this.appointments.forEach((appointment) => {
    			this.timeslots.filter((timeslot, index) => {
    				if(appointment.time == timeslot.time) {
						self.timeslots[index].disable = true;
    					return true;
    				}
				}); //it will throw all of the results(the similar timeslots and appointment.time) into result
    		});
    	},
    	chosenTime: function(index) {
            this.picked = this.timeslots[index].time;
            console.log(this.picked);
            axios.get(`/services/${this.service.id}/staffs/${this.staff.id}/appointments/details?time=${this.picked}&date=${this.date}`)
            .then(({ data }) => {
                window.location.href = data;
            }, (error) => {
          window.location.href = error.response.data;
        });
        },
    }
}
</script>

//find the index of the button and make the disable to false.