var debugar = true; 
function depurador(mensagem){
	if(debugar){
		console.log("=================\n"+mensagem+"\n=================")
	}
}
function validaCampos(login,senha,telefone){
   depurador("Validação de campos realizada");
   if(login == "" || senha == "" || telefone == ""){
	   	sweetAlert("Oops...", "PREENCHA DIREITINHO AMIGO!", "error");
	   	event.preventDefault();
	   	return 0;
	}
	return 1;
}
function verificarLogin(){
	depurador("Verificação de Login");
	if(!localStorage.getItem("logado") || !localStorage.getItem("token")){
		window.location.href = 'index.html';
	}
}
function preparaCadastrar(){
		$("#loginCadastro").empty("");
		$("#senhaCadastro").empty("");
		$('#modalCadastro').modal('show'); 
		loadMascaraTelefone();
		 event.preventDefault();
	}
function preparaEditar(usuario_id,nome,telefone){
	
		$("#loginEditar").empty("");
		$("#senhaEditar").empty("");
		$("#telefoneEditar").empty("");

		depurador("Foi solicitado a edição do usuário ID " + usuario_id);
		$("#loginEditar").val(nome);
		$("#usuario_id").val(usuario_id);
		$("#senhaEditar").val("123456");
		loadMascaraTelefone();
		$("#telefoneEditar").val(telefone);
		
		$('#modalEditar').modal('show'); 
	}
function getUsuarios(){
	$("#usuario_id").empty("");
	
	 $.get( "https://chatrobot.com.br/crud/listUsuarios.php")
		  .done(function( data ) {
		  	depurador("Usuários carregados com sucesso!");
		  	$("#tabela").empty("");
			$( data).each( function( index, data ) {
			   $('#tabela').append(
			   	'<tr> \
			   		<td>'+data.usuario_id+'</td> \
			   		<td>'+data.nome+'</td> \
			   		<td>'+data.telefone+'</td> \
			   		<td> \
			   			<i onclick=preparaEditar('+data.usuario_id+',"'+data.nome+'","'+data.telefone+'") class="fa fa-pencil-square-o fa-2x cursor" aria-hidden="true"> \
			   			</i>        <i class="fa fa-trash fa-2x cursor" onclick=removerUsuario('+data.usuario_id+',"'+data.nome+'") aria-hidden="true"></i> \
			   		</td> \
			   	</tr>');
			});	 
	   });
}

function checkClear(usuario_id,token){
   $.post( "https://chatrobot.com.br/crud/checkClear.php", { usuario_id:  encrypt(usuario_id), token:  encrypt(token) })
	  .done(function( response ) {
	  		if(response.status == 'sucesso'){
		  		localStorage.setItem("logado", "true");
				localStorage.setItem("token", token);
				swal({
				  title: "A validação foi um sucesso!",
				  text: "Em instantes você será redirecionado.",
				  timer: 3000,
				  type: "success",
				  showConfirmButton: false
				});
		  		setTimeout(function(){
						window.location.href = 'usuarios.html';
		  		}, 2500);
	  		} 
	});
}

function getRelatorios(){
$("#usuario_id").empty("");
 $.get( "https://chatrobot.com.br/crud/listRelatorios.php")
	  .done(function( data ) {
	  	depurador("Relatórios carregados com sucesso!");
	  	$("#tabela").empty("");
		$( data).each( function( index, data ) {
		   $('#tabela').append(
		   	'<tr> \
		   		<td>'+data.id+'</td> \
		   		<td>'+data.data+'</td> \
		   		<td>'+data.usuario_id+'</td> \
		   		<td>'+data.ip+'</td> \
		   		<td>'+data.navegador+'</td> \
		   		<td>'+data.so+'</td> \
		   		<td>'+data.hostname+'</td> \
		   		<td>'+data.cidade+'</td> \
		   		<td>'+data.estado+'</td> \
		   		<td>'+data.pais+'</td> \
		   		<td>'+data.localizacao+'</td> \
		   		<td>'+data.organizacao+'</td> \
		   		<td>'+data.informacoes+'</td> \
		   	</tr>');
		});	 
   });
}

function removerUsuario(usuario_id,nome){
	swal({
	  title: "Quer mesmo remover o usuário "+nome+" ?",
	  text: "Não será possível recuperar este registro",
	  type: "warning",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  confirmButtonText: "Sim, delete agora!",
		  cancelButtonText: "Cancelar",
	  showLoaderOnConfirm: true,
	},
	function(){
	depurador("Solicitação de Exclusão\nDados Puros:\nID: "+usuario_id+"\nToken: "+localStorage.getItem("token")+"\nDados Criptografados:\nID: "+encrypt(String(usuario_id))+"\nToken: "+encrypt(localStorage.getItem("token")));
	 $.post( "https://chatrobot.com.br/crud/RemoverUsuario.php", {
	  usuario_id: encrypt(String(usuario_id)),
	   token: encrypt(localStorage.getItem("token"))  })
	  .done(function( data ) {
	  		if(data.status == 'sucesso'){
			    swal("O usuário "+nome+" foi removido.");
				tabelaPadrao();
				getUsuarios();
	  		}
     });
	});
}

function editarUsuario(login,senha,telefone,usuario_id){
 	depurador("Solicitação de Edição\nDados Puros:\nID: "+usuario_id+"\nToken: "+localStorage.getItem("token")+"\nDados Criptografados:\nID: "+encrypt(String(usuario_id))+"\nToken: "+encrypt(localStorage.getItem("token")));
   $.post( "https://chatrobot.com.br/crud/editUsuario.php", { login: encrypt(login), 
   	senha: encrypt(senha),  token: encrypt(localStorage.getItem("token")),
   	telefone: encrypt(telefone), usuario_id: encrypt(usuario_id)  } )
  .done(function( data ) {
  		if(data.status == 'sucesso'){
	  		swal({   title: "SUCESSO!",   text: "Você será redirecionado em 2,5 segundos.",   timer: 2500,   showConfirmButton: false });
	  		getUsuarios();
	  		$('#modalEditar').modal('hide');  
	  		tabelaPadrao();
			getUsuarios();
  		}
	});
}

function cadastroUsuario(login,senha,telefone,usuario_id){
	depurador("Solicitação de Edição\nDados Puros:\nLogin: "+login+"\nToken: "+localStorage.getItem("token")+"\nDados Criptografados:\nLogin: "+encrypt(login)+"\nToken: "+encrypt(localStorage.getItem("token")));
	$.post( "https://chatrobot.com.br/crud/cadastrarUsuario.php", { login: encrypt(login), senha: encrypt(senha), token: encrypt(localStorage.getItem("token")) , telefone: encrypt(telefone)} )
	.done(function( data ) {
			if(data.status == 'sucesso'){
			swal({   title: "SUCESSO!",   text: "Você será redirecionado em 2,5 segundos.",   timer: 2500,   showConfirmButton: false });
			getUsuarios();
			$('#modalCadastro').modal('hide');  
			tabelaPadrao();
			getUsuarios();
			}
	});
}

function loadMascaraTelefone(){
		var SPMaskBehavior = function (val) {
	      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	    },
	    spOptions = {
	      onKeyPress: function(val, e, field, options) {
	          field.mask(SPMaskBehavior.apply({}, arguments), options);
	        }
	    };

	    $('.sp_celphones').mask(SPMaskBehavior, spOptions);
}

function tabelaPadrao(){
	 $('#tabela').empty("");
	 $('#tabela').html('<tr> \
							<td align="center" colspan="13"> \
							<img width="100" height="50" src="img/loading.gif"> Carregando dados...  \
							</td> \
						  </tr> \
	  ');
	
}

