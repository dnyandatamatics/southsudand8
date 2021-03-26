
var $ = jQuery.noConflict();

$(document).ready(function(){
	

          if('crm_2021' == drupalSettings.ajaxPageState.theme){
          //display map
		  //
          var map = L.map('map').setView([7.6949,25.8627], 5);
          //https://api.mapbox.com/styles/v1/iompreacher/ciy3q3lqy00012rpboavecojw/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaW9tcHJlYWNoZXIiLCJhIjoiY2l5M3Eya3luMDAwZjJ3cDEwZXcyODE1cCJ9.RH31fiArda27HIIqy2NWuQ
          L.tileLayer('https://api.mapbox.com/styles/v1/iompreacher/ciy3q3lqy00012rpboavecojw/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaW9tcHJlYWNoZXIiLCJhIjoiY2l5M3Eya3luMDAwZjJ3cDEwZXcyODE1cCJ9.RH31fiArda27HIIqy2NWuQ', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          var rows = drupalSettings.crm_complaint.rows;
   

          for(var i=0; i < rows.length; i++){
            var result = rows[i];

            //var mapItem = new MapItem(result);
          

            if(result.Coordinates) {
              //alert(mapItem.print());
              var icon = L.divIcon({
                html: '<div class="mapItem" data-size="' + result.Count  + '"><span>' + result.Count + '</span></div>',
                iconSize: new L.Point(40, 40)
              });

              var marker = L.marker(result.Coordinates, {'icon': icon});
              marker.addTo(map);

              //var mapItemOrig = getOrigMapItem(mapItem, drupalSettings.crm_awareness.orows);
              var popupStr = "<div id='" + result.CampId +"'>See all <a href='" + drupalSettings.crm_complaint.location + result.CampId +
                  "'>" + result.Count + " case(s)</a> in " + result.CampName + "</div>"
              var popup = L.popup().setContent(popupStr);
              marker.bindPopup(popup);
            }
          }

          $(".mapItem").each(function(index, value){
            var obj = $(value);
            var size = obj.attr("data-size");

            var mapDisplay = new MapDisplay(size);
            var inner = mapDisplay.getInnerSize() + "px";
            var outer = mapDisplay.getOuterSize() + "px";
            var innerR = mapDisplay.getInnerRadius() + "px";
            var outerR = mapDisplay.getOuterRadius() + "px";

            obj.parent().css({
              width:outer,
              height:outer,
              "margin-left":"-" + outerR,
              "margin-top":"-" + outerR,
              "border-radius":outerR,
              "background-color":"rgba(181,226,140,0.6)",
              border:"none"
            });
            obj.css({
              width:inner,
              height:inner,
              "margin-left":"5px",
              "margin-top":"5px",
              "border-radius":innerR,
              "background-color":"rgba(0, 132, 68, 0.6)",
              "text-align":"center"
            });
            obj.children().css("line-height", inner);


          })

          //make clickable filters
          $("body.page-complaints-mechanism .views-exposed-form .views-exposed-widgets .views-exposed-widget > label").click(function() {
            $(this).next().toggle(300);
            var bgImg = $(this).css('background-image');
            if(bgImg.indexOf('icon-close.png') != -1 ){
              $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-expand.png")');
            }else{
              $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-close.png")');
            }
          });

        }


     // $('#publication-search-map').vectorMap(options);

  });
/*
function getOrigMapItem(mapItem, orows){
  for(var i=0; i < orows.length; i++){
    if(orows[i].taxonomy_term_data_field_data_field_camp_of_survivor_tid == mapItem.getCampId()){
      return new MapItem(orows[i]);
    }
  }
  return false;
}
*/

function MapDisplay(size){
  this.size = size;
  this.start = 30;
  var that = this;

  this.getSize = function(){
    return that.size;
  }

  this.getInnerSize = function(){
    var x = that.size;
    var y = .0000000002*x^6 - .00000006*x^5 + .000008*x^4 - 0.0039*x^3 + 0.0329*x^2 + 3.4007*x + 25.401;
    return Math.round(Number(y));
  }

  this.getOuterSize = function(){
    return that.getInnerSize() + 10;
  }

  this.getInnerRadius = function(){
    return Math.round(Number(that.getInnerSize()/2));
  }

  this.getOuterRadius = function(){
    return Math.round(Number(that.getOuterSize()/2));
  }


}
/*
function MapItem(record){
  this.record = record;
  var that = this;
  this.getSize = function(){
    var count = that.getCount();
    var size = 'small';
    if(count > 10){
      size = 'medium';
    }
    return size;
  }

  this.getCoordinates = function(){
    var lon = that.getLongitude();
    var lat = that.getLatitude();

    if(!(lat && lon)){
      return false;
    }
    return [lat, lon];
  }

  this.getLongitude = function(){
    return that.record.taxonomy_term_data_field_data_field_camp_of_survivor__field_
  }

  this.getLatitude = function(){
    return that.record.taxonomy_term_data_field_data_field_camp_of_survivor__field__1
  }

  this.getCount = function(){
    return that.record.node_title;
  }

  this.getCampName = function(){
    return that.record.taxonomy_term_data_field_data_field_camp_of_survivor_name ;
  }

  this.getCampId = function(){
    return that.record.taxonomy_term_data_field_data_field_camp_of_survivor_tid;
  }

  this.print = function(){
    return that.getCampName() + ' (' + that.getCount() +') = ' + that.getCoordinates() ;
  }
}
	
*/


(function ($, Drupal,drupalSettings) {
	
  Drupal.behaviors.crm_complaint = {
     attach: function (context, drupalSettings) {
	

     

    }
  };

})(jQuery, Drupal,drupalSettings);

