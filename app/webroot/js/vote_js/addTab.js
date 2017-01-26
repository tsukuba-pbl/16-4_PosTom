function addTab(name, content){
  $('#tabnav ul').append('<li><a href="#' + name + '">' + name + '</a></li>');
  $('#tabs').tabs();
}
