window.onload = function() {
  var els = document.getElementsByClassName('addfield');
  for (var i = 0; i < els.length ; i++ ){
    els[i].addEventListener('click', addfield, false);
  }
  var els = document.getElementsByClassName('addfieldset');
  for (var i = 0; i < els.length ; i++ ){
    els[i].addEventListener('click', addfieldset, false);
  }
  var els = document.getElementsByClassName('remove');
  for (var i = 0; i < els.length ; i++ ){
    els[i].addEventListener('click', removefield, false);
  }
  
  var els = document.getElementsByClassName('adddocument');
  for (var i = 0; i < els.length ; i++ ){
    els[i].addEventListener('click', adddocument, false);
  }
}

function removefield(ev) {
  event.preventDefault();
  
  ev.target.parentNode.parentNode.parentNode.removeChild(ev.target.parentNode.parentNode);
}

function addfield(ev) {
  event.preventDefault();
  
  var name = prompt('Create new field', 'fieldname');
  if (name != '' && name != null) {
  
    var key = ev.target.getAttribute('data-parentkey') + '[' + name + ']';
  
    var legend = document.createElement('legend');
    legend.innerHTML = name;
  
    var remove = document.createElement('a');
    remove.setAttribute('href','#');
    remove.setAttribute('class','remove');
    remove.innerHTML = "remove";
    remove.addEventListener('click', removefield, false);
  
    var nav = document.createElement('nav');
    nav.appendChild(remove);
  
    var input = document.createElement('input');
    input.setAttribute('type','text');
    input.setAttribute('value','');
    input.setAttribute('name',key);
    input.setAttribute('id',key);
  
    var fieldset = document.createElement('fieldset');
    fieldset.appendChild(legend);
    fieldset.appendChild(input);
    fieldset.appendChild(nav);
    ev.target.parentNode.parentNode.insertBefore(fieldset, ev.target.parentNode.nextSibling);
  
  }
}

function addfieldset(ev) {
  
  event.preventDefault();
  
  var name = prompt('Create new fieldset', 'fieldsetname');
  if (name != '' && name != null) {
  
    var key = ev.target.getAttribute('data-parentkey') + '[' + name + ']';
  
    var legend = document.createElement('legend');
    legend.innerHTML = name;
  
    var add = document.createElement('a');
    add.setAttribute('href','#');
    add.setAttribute('class','addfield');
    add.setAttribute('data-parentkey',key);
    add.innerHTML = "addfield";
    add.addEventListener('click', addfield, false);
  
    var addset = document.createElement('a');
    addset.setAttribute('href','#');
    addset.setAttribute('class','addfieldset');
    addset.setAttribute('data-parentkey',key);
    addset.innerHTML = "addfieldset";
    addset.addEventListener('click', addfieldset, false);
  
    var remove = document.createElement('a');
    remove.setAttribute('href','#');
    remove.setAttribute('class','remove');
    remove.innerHTML = "remove";
    remove.addEventListener('click', removefield, false);
  
    var nav = document.createElement('nav');
    nav.appendChild(add);
    nav.appendChild(addset);
    nav.appendChild(remove);
  
    var fieldset = document.createElement('fieldset');
    fieldset.appendChild(legend);
    fieldset.appendChild(nav);
  
    ev.target.parentNode.parentNode.insertBefore(fieldset, ev.target.parentNode.nextSibling);
  }
}

function adddocument(ev) {
  
  event.preventDefault();
  
  var name = prompt('Create new document', 'name');
  if (name != '' && name != null) {
  
    var key = ev.target.getAttribute('data-parentkey') + '[' + name + ']';
  
    var legend = document.createElement('legend');
    legend.innerHTML = name;
  
    var add = document.createElement('a');
    add.setAttribute('href','#');
    add.setAttribute('class','addfield');
    add.setAttribute('data-parentkey',key);
    add.innerHTML = "addfield";
    add.addEventListener('click', addfield, false);
  
    var add = document.createElement('a');
    add.setAttribute('href','#');
    add.setAttribute('class','addfield');
    add.setAttribute('data-parentkey',key);
    add.innerHTML = "addfield";
    add.addEventListener('click', addfield, false);
  
    var addset = document.createElement('a');
    addset.setAttribute('href','#');
    addset.setAttribute('class','addfieldset');
    addset.setAttribute('data-parentkey',key);
    addset.innerHTML = "addfieldset";
    addset.addEventListener('click', addfieldset, false);
  
    var remove = document.createElement('a');
    remove.setAttribute('href','#');
    remove.setAttribute('class','remove');
    remove.innerHTML = "remove";
    remove.addEventListener('click', removefield, false);
  
    var nav = document.createElement('nav');
    nav.appendChild(add);
    nav.appendChild(addset);
    nav.appendChild(remove);
  
    var namelegend = document.createElement('legend');
    namelegend.innerHTML = 'name';
  
    var nameinput = document.createElement('input');
    nameinput.setAttribute('type','text');
    nameinput.setAttribute('value',name);
    nameinput.setAttribute('name',key  + '[name]');
    nameinput.setAttribute('id',key  + '[name]');
  
    var nameremove = document.createElement('a');
    nameremove.setAttribute('href','#');
    nameremove.setAttribute('class','remove');
    nameremove.innerHTML = "remove";
    nameremove.addEventListener('click', removefield, false);
  
    var namenav = document.createElement('nav');
    namenav.appendChild(nameremove);
  
    var namefieldset = document.createElement('fieldset');
    namefieldset.appendChild(namelegend);
    namefieldset.appendChild(nameinput);
    namefieldset.appendChild(namenav);
  
    var fieldset = document.createElement('fieldset');
    fieldset.appendChild(legend);
    fieldset.appendChild(nav);
    fieldset.appendChild(namefieldset);
  
    ev.target.parentNode.parentNode.insertBefore(fieldset, ev.target.parentNode.nextSibling);
  
  }
}