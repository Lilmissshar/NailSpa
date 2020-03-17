<template>
	<div class="container form-group has-label">
		<label>Services available
			<star class="star">*</star>
			<div class="btn btn-primary" v-on:click="addService()">Add More</div>

			<div class="row" v-for="(service, index) in services">
		      <div class="col-10 pl-3">
		        <input type="text" class="form-control px-4" name="services" id="services" v-on:keyup="viewService(index)" v-model="service.name" autocomplete="off" required>
		        <input type="hidden" name="service_id[]" v-model="service.id">
		        <ul v-if="service.showList" class="team-search-display pl-0">
		          <li v-for="list in lists" v-on:click="serviceOption(list, index)" class="border-bottom-gray px-2 mt-2 text-left">
		            {{ list.name }}
		          </li>
		        </ul>
		      </div>

		      <div class="col-2">
		        <div class="btn btn-info d-inline-block ml-3" v-on:click="deleteService(index)">Remove</div>
		      </div>
		    </div>
	 	</label>
	</div>
</template>

<script>
	export default {
		props: ['propServices'],
		data: function() {
			return {
				services: [{
					"id": null,
					"name": null,
					"showList": false
				}],
				lists: [],
				clickedData: []
			};
		},
		mounted() {
			if(!this.propServices) {
				return;
			}

			this.services = JSON.parse(this.propServices);
		},
		methods: {
			addService: function() {
				console.log("addService")
				this.services.push({
					"id": null,
					"name": null,
					"showList": false
				})
			},
			deleteService: function(index) {
				console.log("delteService")
				this.services.splice(index, 1); 
			},
			viewService: function(index) {
				console.log("viewService")
				axios.get('/admin/services?' + 'ids=' + JSON.stringify(this.clickedData)) //from array(clickedData) into string
				.then(({ data }) => {
					this.lists = data.rows;
					this.services[index].showList = true;
				}) 
			},
			serviceOption: function(list, index) {
				console.log("ServiceOption")
				this.services[index].id = list.id;
				this.services[index].name = list.name;
				this.clickedData.push(list.id);
				this.services[index].showList = false;	
			}//pass in the service as a prop, then check the default function if u have the prop have any value. if not then create, otherwise its edit
		}	
	}
</script>