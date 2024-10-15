$(document).ready(function(){
  var page = location.pathname.split('/');
  page=page[1];
  $('#navbar li a[href="/' + page + '"]').parent(this).attr("itemscope","");
  $('#navbar li a[href="/' + page + '"]').parent(this).attr("itemtype","http://data-vocabulary.org/Breadcrumb");

});