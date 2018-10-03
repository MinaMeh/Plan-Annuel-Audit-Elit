function fetch_data(app_id){
  $.ajax({
    type:'get', 
    url:'/showUserApps',
    data:{app_id:app_id},
    success:function(data){
      $('#appusers').html(data);
       
      console.log(data);
          },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}
function addUserApp(app_id){
  
 
  var user=$('#user').text();
  var password=$('#password').text();
  var role=$('#role').text();
  if (user==''){
    alert('Remplir le champs user');
    return false;
  }
  if (password==''){
    alert('Remplir le champs password');
    return false;
  }
  if (role==''){
    alert('Remplir le champs role');
    return false;
  }
  if (app_id==''){
    alert('Aucune application sélectionnée');
    return false;
  }
  $.ajax({
    type:'get', 
    url:'/addUserApp',
    data:{user:user,password:password,role:role,app_id:app_id},
    success:function(data){
     // console.log(data);
      fetch_data(app_id); 
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
 

}
function addProjetReaudit(projet_id){
  
  var numero=$('#numero').val();
  var date_debut=$('#date_debut').val();
  var date_fin=$('#date_fin').val();
  $.ajax({
    type:'get', 
    url:'/addProjetReaudits',
    data:{numero:numero,date_debut:date_debut,date_fin:date_fin,projet_id:projet_id},
    success:function(data){
      console.log(data);
      fetch_data_reaudit(projet_id); 
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
 

}
function fetch_data_reaudit(projet_id){
  
  $.ajax({
    type:'get', 
    url:'/showProjetReaudits',
    data:{projet_id:projet_id},
    success:function(data){
      $('#projetReaudits').html(data);
      console.log(data);

          },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}
function fetch_data_server(app_id){
  $.ajax  ({
    type:'get', 
    url:'/showUserServers',
    data:{app_id:app_id},
    success:function(data){
      $('#appservers').html(data);
     // console.log(data);

          },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}

function addUserServer(app_id){
  
 
  var addresse_ip=$('#addresse_ip').text();
  var port=$('#port').text();
  var user=$('#user_server').text();
  var password=$('#password_server').text();
  var user_ssh=$('#user_ssh').text();
  var password_ssh=$('#password_ssh').text();
  var tech=$('#tech').text();

  /*if (user==''){
    alert('Remplir le champs user');
    return false;
  }
  if (password==''){
    alert('Remplir le champs password');
    return false;
  }
  if (role==''){
    alert('Remplir le champs role');
    return false;
  }
  if (app_id==''){
    alert('Aucune application sélectionnée');
    return false;
  }*/
  $.ajax({
    type:'get', 
    url:'/addUserServer',
    data:{app_id:app_id,addresse_ip:addresse_ip,port:port,user:user,password:password,user_ssh:user_ssh,password_ssh:password_ssh,tech:tech},
    success:function(data){
 fetch_data_server(app_id);     },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
 

}


function editAppUser(id, colomn,val){
  $.ajax({
    type:'get',
    url:'/updateAppuser',
    data:{id:id, colomn:colomn,val},
     success:function(data){
     // console.log(data);
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}
function editAppServer(id, colomn,val){
  $.ajax({
    type:'get',
    url:'/updateAppServer',
    data:{id:id, colomn:colomn,val},
     success:function(data){
      //console.log(data);
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}

function editVuln(id, colomn,val){
  $.ajax({
    type:'get',
    url:'/updateVuln',
    data:{id:id, colomn:colomn,val:val},
     success:function(data){
      $('#total'+id).html(data);
      console.log(data);
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}
function editReaudit(id, colomn,val){
  $.ajax({
    type:'get',
    url:'/updateProjetReaudit',
    data:{id:id, colomn:colomn,val:val},
     success:function(data){
     
      console.log(data);
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
}


