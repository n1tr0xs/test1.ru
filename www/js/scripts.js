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
  var el = document.getElementById('address');
  if(el.value == ''){
    el.setCustomValidity('Введите адрес');
    return;
  }else el.setCustomValidity('');

  var el = document.getElementById('description');

  if(el.value == ''){
    el.setCustomValidity('Опишите возникшую проблему');
    return;
  }else el.setCustomValidity('');
 
}
