jQuery(document).ready(function($) {
  console.log("hello")
  var geo = new google.maps.Geocoder;


  document.getElementById("search-tz").addEventListener("click", function(e) {
    e.preventDefault;
    console.log("ehllo")
    var tz_text = document.getElementById("tz-search-input").value;
  geo.geocode({'address':tz_text,'region':''},function(results, status){
    if (status == google.maps.GeocoderStatus.OK) {
      var point = results[0].geometry.location;
      var lat = point.lat();
      var lng = point.lng();
    const data_for_user = {};
    data_for_user['action'] = 'return_timezone_search_results';
    data_for_user['lat'] = lat;
    data_for_user['lng'] = lng;

    jQuery.ajax({
      type:'POST',
      url: d2l_gm_tz_ajax.ajaxurl,
      data: data_for_user,
      beforeSend:function(){
        // can do something before data is sent
      },        
      success: function(res) {
        console.log(res);
        var tz_holder = document.getElementById('tz-placeholder');
        tz_holder.innerHTML = res;
      } // success
    }); // jQuery.ajax
      console.log(point.lng());
      console.log(results);
      // jQuery('#aphs_FYN_latitude').val(point.lat());
      // jQuery('#aphs_FYN_longitude').val(point.lng());
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });

    


  })
})