function validateForm(){
  var el = document.getElementById('type');
  if(el.selectedIndex == 0){
    el.setCustomValidity('Выберите тип услуги');
    return;
  } else el.setCustomValidity('');

  var el = document.getElementById('category');
  if(el.selectedIndex == 0){
    el.setCustomValidity('Выберите категорию услуги');
    return;
  }else el.setCustomValidity('');

  var el = document.getElementById('city');
  if(el.selectedIndex == 0){
    el.setCustomValidity('Выберите населенный пункт');
    return;
  }else el.setCustomValidity('');

  var el = document.getElementById('street');
  if(el.selectedIndex == 0){
    el.setCustomValidity('Выберите улицу');
    return;
  }else el.setCustomValidity('');

  var el = document.getElementById('description');
  if(el.value == ''){
    el.setCustomValidity('Опишите возникшую проблему');
    return;
  }else el.setCustomValidity('');

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
