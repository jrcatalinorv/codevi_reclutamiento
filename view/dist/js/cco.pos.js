/* CCO POS Functions & Methos */
const formatter = new Intl.NumberFormat('en');

$('#btnTable').click(function(){
	$('#grid').empty(); 
	document.getElementById('utensilsTitle').innerHTML = '<i class="fas fa-th"></i> Mesas ';
	$('#grid').load("model/roux_select_Tables.php");
}); 
$('#btnMenu').click(function(){
	$('#grid').empty();
	document.getElementById('utensilsTitle').innerHTML = '<i class="fas fa-book-open"></i> Menu';
	$('#grid').load("model/roux_select_MenuCategory.php");
}); 
$('#btnCustomer').click(function(){
	$('#grid').empty(); 
	document.getElementById('utensilsTitle').innerHTML = '<i class="fas fa-users"></i> Clientes ';
	$('#grid').load("model/roux_select_customers.php");
	
}); 

function addLine(id,str,code,price){
	$(".itemList").append('<div class="row posNewLine vcd'+id+'">'+
							   '<div class="col-6">'+
									'<div class="input-group input-group-sm">'+
										'<div class="input-group-append">'+
											'<button type="button" class="btn btn-danger quitarItem"><i class="fas fa-times"></i></button>'+
											'</div>'+
											'<input type="text" value="'+str+'" class="form-control actualItemDesc" itemID="'+id+'" itemCode="'+code+'" readonly >'+
										'</div>'+
									'</div>'+				  
               	  '<div class="col-2 itmqty">'+
				  	'<div class="input-group input-group-sm mb-3">'+
						'<input id="vcdq'+id+'" name="vcdq'+id+'" type="number" min="1" value = "1" class="form-control actualCantItem" >'+
					'</div>'+
				  '</div>'+     
				  '<div class="col-3 ingresoPrecio">'+
				  	'<div class="input-group input-group-sm mb-3">'+
						'<div class="input-group-prepend">'+
							'<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
						'</div>'+
						'<input type="text" class="form-control actualPrecioItem" value="'+price+'" precioReal="'+price+'" readonly >'+
					'</div>'+
					'</div>'+
					'<div class="col-1">'+
					'<a href="#" class="subtractQty" mid="'+id+'"><i class="fas fa-minus-circle fa-2x text-danger"></i></a>'+
					'</div>'+
				  
				'</div>');		
	listarServicio();
    sumarTotalPrecios();
} 
function listarServicio(){
	var listaItems = [];
	var descripcion = $(".actualItemDesc");
	var cantidad = $(".actualCantItem");
	var precio = $(".actualPrecioItem");
	var note = "";


	for(var i = 0; i < descripcion.length; i++){
		listaItems.push({ "id" 		: $(descripcion[i]).attr("itemID"), 
						  "code" 	: $(descripcion[i]).attr("itemCode"),
						  "item" 	: $(descripcion[i]).val(),
						  "cantidad": $(cantidad[i]).val(),
						  "precio" 	: $(precio[i]).attr("precioReal"),
						  "total" 	: $(precio[i]).val(),
						  "nota" 	: $(note[i]).val()})
	}
	$("#itemListJSON").val(JSON.stringify(listaItems)); 
}
function sumarTotalPrecios(){
	var precioItem = $(".actualPrecioItem");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){
		 arraySumaPrecio.push(Number($(precioItem[i]).val())); 
	}

	function sumaArrayPrecios(total, numero){
		return total + numero;
	}
	var precioNeto = arraySumaPrecio.reduce(sumaArrayPrecios);
	var valueTip = $('#tipPer').val();
	var valueITBIS = $('#itbis').val();
	
	var calcITBIS = precioNeto * (valueITBIS/100);
	var calcTip = precioNeto * (valueTip/100); 
	var sumaTotalPrecio = precioNeto + calcITBIS +  calcTip;
	
	$("#nuevoPrecioImpuesto").val(roundToTwo(calcITBIS));
	$("#nuevoPrecioNeto").val(precioNeto);
	$("#tip").val(roundToTwo(calcTip));
	$("#totalVenta").val(sumaTotalPrecio);
	//$("#nuevoTotalVenta").val(formatter.format(sumaTotalPrecio,2));
	$("#nuevoTotalVenta").val(formatter.format(sumaTotalPrecio,2));
}
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
function isEmpty(str) {
    return (!str || 0 === str.length);
}

/* modificar cantidad del item por up/down */
$('.itemList').on("change", "input.actualCantItem", function(){
	var cantidadServicio = $(this);
	var precioServicio  = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".actualPrecioItem");
	var precioFinal =  cantidadServicio.val() * precioServicio.attr("precioReal");

	precioServicio.val(precioFinal);
	sumarTotalPrecios();
	listarServicio();

});

/* modificar cantidad del Item Manual */
$('.itemList').on("keyup", "input.actualCantItem", function(){
	var cantidadServicio = $(this);
	var precioServicio  = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".actualPrecioItem");
	var precioFinal =  cantidadServicio.val() * precioServicio.attr("precioReal");

	precioServicio.val(precioFinal);
	sumarTotalPrecios();
	listarServicio();

});

/* Seleccionar categoria del menu */
$('.utensilsItems').on("click", "button.selectMenuItem", function(){ 
	var categ = $(this).attr('catID');
	var categstr = $(this).attr('catStr');
	$('#grid').empty();
	$('#grid').load("model/roux_select_MenuItem.php?id="+categ);
	document.getElementById('utensilsTitle').innerHTML = '<i class="fas fa-book-open"></i> '+categstr;
 }); 
 
/* Seleccionar Mesa */ 
$('.utensilsItems').on("click", "div.agregarMesa",function(){
	var mesaID = $(this).attr('mesaID');
	var mesaStr = $(this).attr('mesaSTR');
	
	document.getElementById('strtable').innerHTML=mesaStr;
	document.getElementById('tagdivider').innerHTML=" - ";
	$('#tableid').val(mesaID);
	document.getElementById('ddll').innerHTML = '<i class="fas fa-th text-danger"></i> ';
	 
	 
	
}); 

/* Quitar Mesa */ 
$('.utensilsItems').on("click", "div.quitarMesa",function(){
	var mesaID = 0;
	var mesaStr = "";
	
	document.getElementById('strtable').innerHTML=mesaStr;
	document.getElementById('tagdivider').innerHTML=" ";
	$('#tableid').val(mesaID);
	document.getElementById('ddll').innerHTML = '<i class="fas fa-shipping-fast text-danger"></i> ';
}); 
 
/* Seleccionar cliente */ 
$('.utensilsItems').on("click", "div.clienteCard", function(){	 
	var cid = $(this).attr('clienteID');
	var cname = $(this).attr('clienteStr');
	$('#custid').val(cid);
	$('#strcustname').val(cname);
	document.getElementById('strcust').innerHTML=cname;
	//$('#btnUpdate').click();
});
 
 /* Agregar Linea */
$('.utensilsItems').on("click", "button.agregarItem", function(){ 
var str = $(this).attr("itemStr");		
var id = $(this).attr("itemId");		
var code = $(this).attr("itemCode");		
var price = $(this).attr("itemPrice");
var counter = document.getElementsByClassName("posNewLine").length;
if(counter==0){
	addLine(id,str,code,price);
}else{
   var actLine = document.getElementsByClassName("vcd"+id);
   if(actLine.length==0){
	   addLine(id,str,code,price);
   }else{
	  var newCant = parseInt($('#vcdq'+id).val())+1; 
	  $('#vcdq'+id).val(newCant);
	  $('#vcdq'+id).keyup();
   } 
 }
});
$('.itemList').on("click", "a.subtractQty", function(){
	 var id = $(this).attr('mid');
	 var actQt = $('#vcdq'+id).val();
	 
	 if(actQt>1){
		 var newQT = parseInt(actQt)-1;
		 $('#vcdq'+id).val(newQT);
	     $('#vcdq'+id).keyup();
	 }
});
$('.itemList').on("click", "button.quitarItem", function(){ 
 $(this).parent().parent().parent().parent().remove();	
	var counter = document.getElementsByClassName("posNewLine").length;
	if(counter==0){
		$("#nuevoPrecioImpuesto").val(0);
		$("#nuevoPrecioNeto").val(0);
		$("#tip").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#itemListJSON").val("");	
	}else{
		listarServicio();
		sumarTotalPrecios();
	}
 });
$('#propinaBtn').click(function(){
	var option = $('#propinaBtn').attr('btnState');
	switch(option){
		case 'ON': 
				$('#propinaBtn').removeClass('btn-success');
				$('#tipPer').val(0);
				$('#propinaBtn').addClass('btn-danger');
				$('#propinaBtn').attr("btnState","OFF");
				sumarTotalPrecios();
			break;
		case 'OFF':
				$('#propinaBtn').removeClass('btn-danger');
				$('#tipPer').val(10);
				$('#propinaBtn').addClass('btn-success');
				$('#propinaBtn').attr("btnState","ON");
				sumarTotalPrecios();		
			break;
	}
}); 
$('#ITBISBtn').click(function(){
	var option = $('#ITBISBtn').attr('btnState');
	switch(option){
		case 'ON': 
				$('#ITBISBtn').removeClass('btn-info');
				$('#itbis').val(0);
				$('#ITBISBtn').addClass('btn-secondary');
				$('#ITBISBtn').attr("btnState","OFF");
				sumarTotalPrecios();
			break;
		case 'OFF':
				$('#propinaBtn').removeClass('btn-secondary');
				$('#itbis').val(18);
				$('#ITBISBtn').addClass('btn-info');
				$('#ITBISBtn').attr("btnState","ON");
				sumarTotalPrecios();		
			break;
	}
});

$('#btnSave').click(function(){
	var datos = $("#itemListJSON").val();
	var notes = "";
	if(isEmpty(datos)){
		  toastr.error('<b>Debes agregar algun Item para poder crear una orden!</b>'); 
	}else{	
	$.getJSON('model/roux_insert_order.php',{
		orderid: $('#orderid').val(),
		custid:  $('#custid').val(),
		tableid: $('#tableid').val(),
		userid:  $('#userid').val(),
		items:   $("#itemListJSON").val(),
		subtotal:$('#nuevoPrecioNeto').val(),
		tip:	 $('#tip').val(),
		itbis:   $('#nuevoPrecioImpuesto').val(),
		total:   $('#totalVenta').val(),
		nota:	 $('#orderNote').val(),
		nota2:	 $('#strcustname').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
					$('#ordensalvada').val(1);	
					location.href="index.php?ruta=pos-edit&tx="+data['txid'];
					
			break;
		}
	}); 	
}//Fin del else  
});  
$('#btnSaveInv').click(function(){
	switch($('#ordensalvada').val()){
		case '0':   
				var datos = $("#itemListJSON").val();
				var notes = "";
				if(isEmpty(datos)){
					toastr.error('<b>Debe agregar algun Item para poder crear una factura!</b>');  /* No hacer nada */
				}else{
				$.getJSON('model/roux_insert_order.php',{
					orderid: $('#orderid').val(),
					custid:  $('#custid').val(),
					tableid: $('#tableid').val(),
					userid:  $('#userid').val(),
					items:   $("#itemListJSON").val(),
					subtotal:$('#nuevoPrecioNeto').val(),
					tip:	 $('#tip').val(),
					itbis:   $('#nuevoPrecioImpuesto').val(),
					total:   $('#totalVenta').val(),
					nota:	 $('#orderNote').val(),
					nota2:	 $('#strcustname').val()
				},function(data){
					switch(data['ok']){
						case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
						case 1:	 
						
						document.getElementById('triggerModalFacturar').click();
						
						break;
		}
	}); 	
	}//Fin del else 			
break; 
		case '1': document.getElementById('triggerModalFacturar').click(); 	break;
		case '2': location.href="index.php?ruta=ticket&tx="+$('#orderid').val()+"&rt=facturas"; break;
		case '3': toastr.error('<b> Esta Orden fue cancelada. </b>'); break;
		case '4': location.href="index.php?ruta=tickett&tx="+$('#orderid').val()+"&rt=facturas";  break;
		
	}
});
$('#btnUpdate').click(function(){
	var datos = $("#itemListJSON").val();
	var notes = "";
	if(isEmpty(datos)){
		
	}else{	
	$.getJSON('model/roux_update_order.php',{
		orderid: $('#orderid').val(),
		custid:  $('#custid').val(),
		tableid: $('#tableid').val(),
		userid:  $('#userid').val(),
		items:   $("#itemListJSON").val(),
		subtotal:$('#nuevoPrecioNeto').val(),
		tip:	 $('#tip').val(),
		itbis:   $('#nuevoPrecioImpuesto').val(),
		total:   $('#totalVenta').val(),
		nota:	 $('#orderNote').val(),
		nota2:	 $('#strcustname').val()
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1: 
					toastr.success('La Orden #'+data['txid']+' fue actualizada con exito! Y esta lista para facturarse');
					//$('#ordensalvada').val(1);
						
			break;
		}
	}); 	
}//Fin del else  
});
$('.btnSerach').click(function(){
	 location.href="search";
});
$('#order_note_btn').click(function(){
	var note = $('#order_note').val();
	
	$('#orderNote').val(note);
	document.getElementById('btnUpdate').click();
	document.getElementById('close_extended_menu').click();
	document.getElementById('ordeNoteStrAct').innerHTML = note;
	
});


$('.pmBtn').click(function(){
 var payment = $(this).attr('pmth');
 $('#modalPMTH').val(payment);	
});

$('#helpmonto').keyup(function(){
	var monto = $('#totalVenta').val();
	var pago  = $('#helpmonto').val();
	var devuelta = parseInt(pago) - parseInt(monto);
	$('#helpdevuelta').val(devuelta);
});

$('#makeInvoice').click(function(){
	if(isEmpty($('#modalPMTH').val())){
		toastr.warning('Debe seleccionar el metodo de pago');
	}else{
		var TPncf = parseInt($('#modalbcf').val());
		switch(TPncf){
			case 0: 
				$.getJSON('model/roux_insert_invoice.php',{	
					order:$('#orderid').val(),
					pm: $('#modalPMTH').val(),
					ncfType: $('#modalbcf').val(),
					ncfSTR: $('#modalNCF').val(),
					user: $('#userid').val()		
				},function(data){
					switch(data['ok']){
						case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
						case 1: location.href="index.php?ruta=ticket&tx="+data['txid']+"&rt=pos"; break;
						case 2: toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'); break;
					}
				}); 		
				break;
			case 1: 
					if($('#modalncfOK').val()=='NO'){
						toastr.error('No se puede Facturar la Orden - Usted ha consumido todos los NCF disponibles.'); 
					}else{
							$.getJSON('model/roux_insert_invoice_ncf.php',{	
							order:$('#orderid').val(),
							pm: $('#modalPMTH').val(),
							ncfType: 1,
							ncfSTR: $('#modalNCF').val(),
							ncfsq: $('#modalncfseqnumber').val(), 
							name: $('#custName').val(), 
							rnc: $('#custRnc').val(), 
							user: $('#userid').val()		
					},function(data){
							switch(data['ok']){
								case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
								case 1:  toastr.info('OK');
									location.href="index.php?ruta=tickett&tx="+data['txid']+"&rt=pos"; 
									break;
								case 2: toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'); break;
							}
					  });
					}
			break;
			case 2: 
					if($('#modalncfOK').val()=='NO'){
						toastr.error('No se puede Facturar la Orden - Usted ha consumido todos los NCF disponibles.'); 
					}else{
						//save_final_invoice();
					}
			  break;
		}
		
	}
});
$('#modalbcf').change(function(){
  var ctype = parseInt($('#modalbcf').val());
  if(ctype==0){
	  document.getElementById('modalncfstr').innerHTML="";
	  document.getElementById('modalNCFerr').innerHTML="";
	  $('#modalNCF').val("");
	  $('#modalncfseqnumber').val("");
	  $('#modalncfOK').val("NO");
  }else{
	if($('#itbis').val()==0){  
			document.getElementById('ITBISBtn').click(); 
			document.getElementById('btnUpdate').click(); 
	} 
	
	$.getJSON('model/roux_select_nextcf.php',{	
		tp:ctype		
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se pudo almacenar los datos: '+ data['err']); break;
			case 1:  
					$('#modalNCF').val(data['ncf']); 
					$('#modalncfseqnumber').val(data['seq']); 
					$('#modalncfOK').val("YES")
					document.getElementById('modalncfstr').innerHTML=" -"+data['ncf'];
					document.getElementById('modalNCFerr').innerHTML="";
			break;
			case 2: 
				toastr.error('Usted ha consumido todos los NCF disponibles.'); 
				toastr.info('Debe solicitar Comprobantes Fiscales a la DGII y actualizar la secuencia.'); 
				document.getElementById('modalNCFerr').innerHTML=" *** Comprobantes Agotados *** ";
				$('#modalncfOK').val("NO");
				document.getElementById('modalncfstr').innerHTML="";
				$('#modalNCF').val("");
			    $('#modalncfseqnumber').val("");
			break;
		}
	});		

	
  }	
});
 
 
$('#btnCancelOrder').click(function(){
	var st  = $('#ordensalvada').val();
	var inv = $('#orderInvoice').val(); 
	
	if(st==1){
		$('#close_extended_menu').click(); 
		$('#triggerModalCancelar').click(); 
	}else{
		$('#close_extended_menu').click();
		toastr.error('*** Debe Anular la Factura '+inv+' para cancelar la Orden *** ');
	}
	
});	

$('#acceptCanelOrder').click(function(){
	var cdd = $('#orderid').val(); 
	var nnww= 3;	
	 $.getJSON('model/roux_update_StOrden.php',{
		ccdd: cdd,
		stts: nnww
	},function(data){
		switch(data['ok']){
			case 0: toastr.error('ERROR! No se guardaron los cambios los datos: '+ data['err']); break;
			case 1: location.href="pos"; break;
			case 2: toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'); break;
		}
	});
	
});
	
 

$('#cancelInvoice').click(function(){ var tx= $('#orderid').val(); location.href="index.php?ruta=pos-edit&tx="+tx; });
$('#btnfacturaPos').click(function(){ toastr.warning('<b>!Alerta! </b> Debe salvar la orden antes de utilizar este menu!');   });
$('#btnCocinaPos').click(function(){  toastr.warning('<b>!Alerta! </b> Debe salvar la orden antes de utilizar este menu!');   });
$('#btnCancelOrderPos').click(function(){  toastr.warning('<b>!Alerta! </b> Debe salvar la orden antes de utilizar este menu!');   });
$('#btnSplitPos').click(function(){  toastr.warning('<b>!Alerta! </b> Debe salvar la orden antes de utilizar este menu!');   });
$('#btnCotizacionPos').click(function(){  toastr.warning('<b>!Alerta! </b> Debe salvar la orden antes de utilizar este menu!');   });
 