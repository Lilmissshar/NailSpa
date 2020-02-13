$(document).ready(function(){
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});
//   if ($("#datetimepicker").length != 0) {
//     $('.datetimepicker').datetimepicker({
//       useCurrent: false,
//       showClear: true,
//       widgetPositioning: {
//           horizontal: 'auto',
//           vertical: 'auto'
//       },
//       icons: {
//         time: "fa fa-clock-o",
//         date: "fa fa-calendar",
//         up: "fa fa-chevron-up",
//         down: "fa fa-chevron-down",
//         previous: 'fa fa-chevron-left',
//         next: 'fa fa-chevron-right',
//         today: 'fa fa-screenshot',
//         clear: 'fa fa-trash',
//         close: 'fa fa-remove',
//       }
//     });
//   }

// $('#datetimepicker').on('dp.change', function() { 
//     console.log($(this).val()); // get the current value of the input field.
//     var date = $(this).val();
//     var url = $(this).data("url");
//     // location.href = url + '?date=' + date;
//     console.log(date);
//     var url = url + '?date=' + date;
//     console.log(url);
//     // console.log('date: ' + date);

//     let config = {
//       headers:{
//         'Content-Type':'application/json',
//         'Accept':'application/json'
//       }
//     };
//     axios.get(url, config)
//     .then((response)  =>  {
//       console.log(response.data);
//       $('#bootstrap-table').bootstrapTable('load', response.data);
//       // this.emails = response.data;
//       // if(response.data != null){
//       //   this.showList = true;
//       // }
//     }, (error)  =>  {
//       console.log('error', error);
//     });
// });

});

