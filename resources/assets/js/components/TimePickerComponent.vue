<template>
<div class="main">
	<p>Date: <input type="text" class="datepicker" style= "margin:30px" v-on:change="change()"></p>
	<label>Time</label>
	<div class="list-group">
	<ul class="time-slots">
		<li v-for="(timeslot, index) in timeslots">
			<button type="button" class="btn btn-primary" v-on:click="chosenTime(index)" :disabled="timeslot.disable" >{{timeslot.time}}</button>
		</li>
	</ul>	
	</div>
	<button type="button" v-on:click="send()">Submit</button>
</div>
</template>

<script>
  export default {
  	props: ['propBranch', 'propService', 'propStaff', 'propAppointments'], //fixed
    data: function(){
      return {
      	date: null,
		branch: null,
		service: null,
		staff: null,
		appointments: null,
		timeslots: [
			{ time: '0900', disable: false},
			{ time: '1000', disable: false},
			{ time: '1100', disable: false},
			{ time: '1200', disable: false},
			{ time: '1300', disable: false},
			{ time: '1400', disable: false},
			{ time: '1500', disable: false},
			{ time: '1600', disable: false},
			{ time: '1700', disable: false},
			{ time: '1800', disable: false},
			{ time: '1900', disable: false}
		],
		picked: []
		//we create new variables to alter it
      };
    },
    mounted() {
    	this.branch = JSON.parse(this.propBranch);
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
    	dateChange: function(){
    		axios.get(`/branch/${this.branch.id}/services/${this.service.id}/staffs/${this.staff.id}/appointments?date=${this.date}`)
	    	.then(({ data }) => {
	    		this.appointments = data;
	    		this.loadAppoinments();
	    	}, (error) => {
	    		console.log(error);
	  		});	
    	},
    	loadAppoinments: function() {
    		if(!this.appointments) {
    			return;
    		}
    		
    		let self = this;

    		this.appointments.forEach((appointment) => {
    			this.timeslots.filter((timeslot, index) => {
    				if(appointment.time == timeslot.time) {
						self.timeslots[index].disable = true;
    					return true;
    				}else {
    					self.timeslots[index].disable = false;
    				}


				}); //it will throw all of the results(the similar timeslots and appointment.time) into result
    		});
    	},
    	chosenTime: function(index) {
    		this.timeslots[index].disable = true;
    		this.picked.push([this.timeslots[index].time]);
    		console.log(this.picked);

    	},
    	send: function() {
    		axios.get(`/branch/${this.branch.id}/services/${this.service.id}/staffs/${this.staff.id}/appointments/details?time=${this.picked}&date=${this.date}`)
    		.then(({ data }) => {
    			window.location.href = data;
    		})
    	}
    }
  }
</script>