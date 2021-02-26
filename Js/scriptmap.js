function iniciarMap(){
    var coord = {lat:-14.084798 ,lng: -75.726955};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 5,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });


        document.getElementById('alejar').style.display='none';
        document.getElementById('zoom').style.display='inline';
}




function iniciarMap2(){
    var coord = {lat:-14.084798 ,lng: -75.726955};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map

    });

    document.getElementById('zoom').style.display='none';

  	document.getElementById('zoomx2').style.display='inline';

  	}





function iniciarMap3(){
    var coord = {lat:-14.084798 ,lng: -75.726955};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 15,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });

        document.getElementById('zoomx2').style.display='none';
  	document.getElementById('zoomx3').style.display='inline';
}


function iniciarMap4(){
    var coord = {lat:-14.084798 ,lng: -75.726955};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 20,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });

        document.getElementById('zoomx3').style.display='none';
  	document.getElementById('alejar').style.display='inline';
}




