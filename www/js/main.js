$(document).ready(function(){
  $('.required').each(function(i, obj) {
    $(this).html($(this).html() + "*");
  });
});

function validateForm(){
  var el = document.getElementById('type');
  if(el.value == ''){
    el.setCustomValidity('Выберите тип услуги');
    return;
  } else el.setCustomValidity('');

  var el = document.getElementById('category');
  if(el.value == ''){
    el.setCustomValidity('Выберите категорию работ');
    return;
  } else el.setCustomValidity('');

  var el = document.getElementById('city');
  if(el.value == ''){
    el.setCustomValidity('Выберите населенный пункт');
    return;
  }else el.setCustomValidity('');

  var el = document.getElementById('street');
  if(el.value == ''){
    el.setCustomValidity('Выберите улицу');
    return;
  } else el.setCustomValidity('');

  var el = document.getElementById('description');
  if(el.value == ''){
    el.setCustomValidity('Опишите возникшую проблему');
    return;
  } else el.setCustomValidity('');
}

function loadStreets(){
  datalist = document.getElementById("streets");
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200)
       datalist.innerHTML = this.responseText;
       document.getElementById("street").disabled = false;
       document.getElementById("street").placeholder = "";
  };
  var selected = document.getElementById('city').value;
  xhttp.open('get', 'get_streets.php?city='+encodeURIComponent(selected), true);
  xhttp.send();
}

function enableHouse(){
  document.getElementById('house').disabled = false;
  document.getElementById('house').placeholder = "";
}

function enableFlat(){
  document.getElementById('flat').disabled = false;
  document.getElementById('flat').placeholder = ""
}

function selectAll(name){
  childs = document.querySelectorAll('form[name="status"] input[type="checkbox"]');
  childs.forEach((cb) => {
    cb.checked = true;
  });
  return;
}

function unselectAll(name){
  var childs = document.querySelectorAll('form[name="status"] input[type="checkbox"]');
  childs.forEach((cb) => {
    cb.checked = false;
  });
  return;
}
