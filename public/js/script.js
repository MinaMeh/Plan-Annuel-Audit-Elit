$(document).on('ready',function(){
$('#nature_client').on('change', function() {
    
      if (this.value=="Externe"){
        $("#INT").collapse("hide");
        $("#EXT").collapse("show");
        
      }
      if (this.value=="Interne"){
        $("#EXT").collapse("hide");
        $("#INT").collapse("show");
        
      }
      

    });
$('#autre_np').change(function(){
        if ($(this).is(':checked')) {
            $("#autre_tech_np").collapse("show");
        }
        else{
           $("#autre_tech_np").collapse("hide");
        }
    });
$('#autre').change(function(){
        if ($(this).is(':checked')) {
            $("#autre_tech").collapse("show");
        }
        else{
           $("#autre_tech").collapse("hide");
        }
    });
$('#change').change(function(){
        if ($(this).is(':checked')) {
            $("#change_nom").collapse("show");
        }
        else{
           $("#change_nom").collapse("hide");
        }
    });
 $('#nature_client_np').on('change', function() {
      
      if (this.value=="Externe"){
        $("#INT_np").collapse("hide");
        $("#EXT_np").collapse("show");
        
      }
      if (this.value=="Interne"){
        $("#EXT_np").collapse("hide");
        $("#INT_np").collapse("show");
        
      }
      

  });

$('#client_demande').change(function(){
  $.ajax({
               type:'get',
               url:'/getApps',
               data:{'client':$('#client_demande').val()},
               success:function(data){
                  $("#apps_list").html(data);
                 // console.log(data);   
               //   console.log($('#client_demande').val()); 
                }
            });

})

$('#nature_client_demande').change(function(){
  $.ajax({
               type:'get',
               url:'/getClients',
               data:{'nature_client':$('#nature_client_demande').val()},
               success:function(data){
                  $("#client_demande").html(data);
                              }
            });

})


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



$(document).on ('blur',  '.username',function(){
  var id= $(this).data('id1');
  var val=$(this).text();
  editAppUser(id,"username",val);
})
$(document).on ('blur',  '.password',function(){
  var id= $(this).data('id2');
  var val=$(this).text();
  editAppUser(id,"password",val);
})
$(document).on ('blur',  '.role',function(){
  var id= $(this).data('id3');
  var val=$(this).text();
  editAppUser(id,"role",val);
})
$(document).on ('blur',  '.ip_address',function(){
  var id= $(this).data('id1');
  var val=$(this).text();
  editAppServer(id,"addresse_ip",val);
})
$(document).on ('blur',  '.port',function(){
  var id= $(this).data('id2');
  var val=$(this).text();
  editAppServer(id,"port",val);
})
$(document).on ('blur',  '.user_server',function(){
  var id= $(this).data('id3');
  var val=$(this).text();
  editAppServer(id,"user",val);
})
$(document).on ('blur',  '.password_server',function(){
  var id= $(this).data('id4');
  var val=$(this).text();
  editAppServer(id,"password",val);
})
$(document).on ('blur',  '.user_ssh',function(){
  var id= $(this).data('id5');
  var val=$(this).text();
  editAppServer(id,"user_ssh",val);
})
$(document).on ('blur',  '.password_ssh',function(){
  var id= $(this).data('id6');
  var val=$(this).text();
  editAppServer(id,"password_ssh",val);
})
$(document).on ('blur',  '.tech',function(){
  var id= $(this).data('id7');
  var val=$(this).text();
  editAppServer(id,"tech",val);
})
$(document).on ('blur',  '.vuln_eleves',function(){
  var id= $(this).data('id2');
  var val=$(this).text();
  editVuln(id,"vuln_eleves",val);
})
$(document).on ('blur',  '.vuln_moyennes',function(){
  var id= $(this).data('id3');
  var val=$(this).text();
  editVuln(id,"vuln_moyennes",val);
})
$(document).on ('blur',  '.vuln_faibles',function(){
  var id= $(this).data('id4');
  var val=$(this).text();
  editVuln(id,"vuln_faibles",val);
})
$(document).on('click','.btn_delete',function(){

  var id=$(this).data('id4');
  $.ajax({
    type:'get',
    url:'/deleteAppuser',
    data:{id:id},
     success:function(data){
     // console.log(data);
      fetch_data($('#apps_list').val());
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
   });
$(document).on('click','.btn_delete_re',function(){

  var id=$(this).data('id4');
  $.ajax({
    type:'get',
    url:'/deleteProjetReaudit',
    data:{id:id},
     success:function(data){
     // console.log(data);
      fetch_data_reaudit($('#projet_id').val());
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
   });
$(document).on('click','.btn_del',function(){

  var id=$(this).data('id8');
  $.ajax({
    type:'get',
    url:'/deleteAppServer',
    data:{id:id},
     success:function(data){
      //console.log(data);
      fetch_data_server($('#apps_list').val());
    },
    error :function(result,status,erreur){
      console.log(result);
      console.log(status);
      console.log(erreur);
      
    }
  });
   });
    $('#editTech').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var designation = button.data('designation');
  var id= button.data('id'); 
  var description = button.data('description');

 // console.log(designation);
  var modal = $(this);
  modal.find('.modal-body #tech_designation').val(designation);
    modal.find('.modal-body #tech_description').val(description);

  modal.find('.modal-body #tech_id').val(id);
});
     $('#editDepart').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
//  console.log('hello');
  var designation = button.data('designation');
  var id= button.data('id'); 
  //console.log(designation);
  var modal = $(this);
  modal.find('.modal-body #designation_depart').val(designation);
  modal.find('.modal-body #id_depart').val(id);
});


      $('#editType').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var designation = button.data('designation');
    var description = button.data('description');

  var id= button.data('id'); 
 // console.log(designation);
  var modal = $(this);
  modal.find('.modal-body #type_id').val(id);
  modal.find('.modal-body #type_designation').val(designation);
    modal.find('.modal-body #type_description').val(description);

});
       $('#editVuln').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var designation = button.data('designation');
    var description = button.data('description');

  var id= button.data('id'); 
 // console.log(designation);
  var modal = $(this);
  modal.find('.modal-body #vuln_id').val(id);
  modal.find('.modal-body #vuln_designation').val(designation);
    modal.find('.modal-body #vuln_description').val(description);

});
  $('#editControle').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var designation = button.data('designation');
    var description = button.data('description');

  var id= button.data('id'); 
 // console.log(designation);
  var modal = $(this);
  modal.find('.modal-body #controle_id').val(id);
    modal.find('.modal-body #controle_description').val(description);

  modal.find('.modal-body #controle_designation').val(designation);
});
       $('#editProcedure').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var designation = button.data('designation');
  var id= button.data('id'); 
  var code =button.data('code');
  var modal = $(this);
  modal.find('.modal-body #procedure_id').val(id);
  modal.find('.modal-body #procedure_designation').val(designation);
    modal.find('.modal-body #procedure_code').val(code);

});
     
        $('#editUser').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var name = button.data('name');
  var id= button.data('id'); 
  var email =button.data('email');
  var password =button.data('password');
  var role =button.data('role');

  var modal = $(this);
  modal.find('.modal-body #user_id').val(id);
    modal.find('.modal-body #user_name').val(name);
  modal.find('.modal-body #user_email').val(email);
  //  modal.find('.modal-body #user_password').val(password);
    modal.find('.modal-body #user_role').val(role);

});
         $('#deleteDepartement').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #id_depart').val(id);
   

});
    $('#deleteTech').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #tech_id').val(id);
   

});

     $('#deleteType').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #type_id').val(id);
   

});


      $('#deleteProcedure').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #procedure_id').val(id);
   

});

      $('#deleteUser').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #user_id').val(id);
 // console.log(id);
   

});
     
 $('#deleteDemande').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #id_demande').val(id);
//  console.log(id);
   

});
  $('#deleteControle').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #controle_id').val(id);
//  console.log(id);
   

});
   $('#deleteVuln').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 
  var id= button.data('id'); 
 
  var modal = $(this);
  modal.find('.modal-body #vuln_id').val(id);
//  console.log(id);
   

});

     $(document).on ('blur',  '.controle',function(){
  var projet= $(this).data('projet');
  var controle=$(this).data('controle');
  var nbr= $(this).text();
  editProjetControle(projet,controle,nbr);
});
    function editProjetControle(projet,controle,nbr){

       $.ajax({
    type:'get',
    url:'/updateProjetControle',
    data:{projet:projet,controle:controle,nbr:nbr},
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
 $(document).on ('change',  '.date_debut',function(){

  var id= $(this).data('id2');
  var val= $(this).val();
  editReaudit(id,"date_debut",val);
});
 $(document).on ('change',  '.date_fin',function(){
  var id= $(this).data('id3');
  var val= $(this).val();
  editReaudit(id,"date_fin",val);
});
 $(document).on ('change',  '.numero',function(){

  var id= $(this).data('id1');
  var val= $(this).val();
  editReaudit(id,"numero",val);
});


  $(document).on ('blur',  '.vulnerabilite',function(){
  var projet= $(this).data('projet');
  var vulnerabilite=$(this).data('vulnerabilite');
  var nbr= $(this).text();
  editProjetVuln(projet,vulnerabilite,nbr);
});
    function editProjetVuln(projet,vuln,nbr){

       $.ajax({
    type:'get',
    url:'/updateProjetVuln',
    data:{projet:projet,vuln:vuln,nbr:nbr},
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
  })