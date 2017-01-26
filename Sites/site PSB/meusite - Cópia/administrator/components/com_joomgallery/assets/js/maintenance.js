function joom_selectnewuser(id)
{
  if(document.adminForm.tab.value == 'categories')
  {
    var task = 'setcategoryuser';
  }
  else
  {
    var task = 'setuser';
  }

  $('newuser').injectInside('correctuser' + id);
  $('filesave').injectInside('correctuser' + id);
  $('filesave').removeEvents();
  $('filesave').addEvent('click', function(){
    listItemTask('cb' + id, task);
  });
}

function joom_selectbatchjob(job)
{
  if(job == 'setuser')
  {
    $('newuser').injectInside('batchjobs');
    $('usertip').injectInside('batchjobs');
    $('filesave').injectInside('garage');
  }
  else
  {
    $('newuser').injectInside('garage');
    $('usertip').injectInside('garage');
    $('filesave').injectInside('garage');
  }

  if(document.adminForm.tab.value == 'categories' && job == 'setuser')
  {
    document.adminForm.task.value = 'setcategoryuser';
  }
  else
  {
    document.adminForm.task.value = job;
  }
}