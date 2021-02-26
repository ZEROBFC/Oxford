
//Este bloque de codigo sirve para interactuar los slides !!!!

document.getElementById('obj1').style.display = 'block';

document.getElementById('obj2').style.display = 'none';

document.getElementById('obj3').style.display = 'none';	
	

function mostrar(){
document.getElementById('obj1').style.display = 'block';
document.getElementById('obj2').style.display = 'none';
document.getElementById('obj3').style.display = 'none';


}


function mostrar2(){
document.getElementById('obj1').style.display = 'none';
document.getElementById('obj2').style.display = 'block';
document.getElementById('obj3').style.display = 'none';

}


function mostrar3(){
document.getElementById('obj1').style.display = 'none';
document.getElementById('obj2').style.display = 'none';
document.getElementById('obj3').style.display = 'block';


}






// enfocar preveniendo o no el scroll

focusScrollMethod = function getFocus() {
  document.getElementById("txtname").focus({preventScroll:false});




}
focusNoScrollMethod = function getFocusWithoutScrolling() {

 


  document.getElementById("txtname").focus({preventScroll:true});


}

