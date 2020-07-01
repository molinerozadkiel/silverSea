d=document;w=window;c=console;
String.prototype.capitalize=function(){return this.charAt(0).toUpperCase()+this.slice(1);}

// color console
c.lof = (message, farbe = false)=>{
	if(farbe){c.log("%c" + message, "color:" + farbe);}
	else{c.log(message)}
};


w.onload=()=>{
	// LAZY LOAD FUNCTIONS MODULE
	var lBs=[].slice.call(d.querySelectorAll(".lazy-background")),lIs=[].slice.call(d.querySelectorAll(".lazy")),opt={threshold:.01};
	if("IntersectionObserver" in window){
	let lBO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.add("visible");lBO.unobserve(l)}})},opt),
		lIO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.remove("lazy");lIO.unobserve(l);l.srcset=l.dataset.url}})},opt);
	lIs.forEach(lI=>{lIO.observe(lI)});lBs.forEach(lB=>{lBO.observe(lB)});
	}

	// cartController.setup();
	productSelector.setup();

	carouselController.setup()
	growUpController.setup()
	obseController.setup()
	cuantosController.setup();
	selectBoxSpace.poblate();
	startMateput();
	cardSetup();


	if (d.getElementById("load")) {
		d.getElementById("load").style.top="-100vh";
	}
	scrollAlter();
}
// console.log(lt_data.ajaxurl)


// deprecated
function postAjaxCall(url,dataNames,dataValues){// return a new promise.
	return new Promise((resolve,reject)=>{// do the usual XHR stuff
		var req=new XMLHttpRequest();
		req.open('post',url);
		//NOW WE TELL THE SERVER WHAT FORMAT OF POST REQUEST WE ARE MAKING
		req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		req.onload =()=>{if(req.status>=200&&req.status<300){resolve(req.response)}else{reject(Error(req.statusText));console.log("ERROR")}}
		req.onerror=()=>{reject(Error("Network Error"))}// handle network errors
		// prepare the data to be sent
		let data;
		for(var i=0;i<dataNames.length;i++){data=data+"&"+dataNames[i]+"="+dataValues[i]}
		// make the request
    req.send(data)
	})
}














// alternates a class from a selector of choice, example:
// <div class="someButton" onclick="altClassFromSelector('activ', '#navBar')"></div>
const altClassFromSelector = ( clase, selector, mainClass = false )=>{
	const x = d.querySelector(selector);
	// if there is a main class removes all other classes
	if(mainClass){
		x.classList.forEach( item=>{
			// TODO: testear si anda con el nuevo condicional
			if( item!=mainClass && item!=clase ){
			x.classList.remove(item);
			}
		});
	}

	if(x.classList.contains(clase)){
		x.classList.remove(clase)
	}else{
		x.classList.add(clase)
	}
}



















// SELECT BOX CONTROLER
// TODO: mejorar eso a clases y POO
const selectBoxControler=(a, selectBoxId, current)=>{ //c.log(a)
	if(!!a){d.querySelector(selectBoxId).classList.add('alt')}
	else   {d.querySelector(selectBoxId).classList.remove('alt')}

	d.querySelector(current).innerHTML=a;
	d.querySelector(selectBoxId).classList.remove('focus')
	d.activeElement.blur();
}

// ACCORDION SELECTOR CONTROLLER
const accordionSelector = (selector) => {
	var acc = d.querySelectorAll(selector);

	acc.forEach((item, i) => {
		item.classList.toggle("active");
		// var panel = this.nextElementSibling;
		if (item.style.maxHeight!=0) {
			item.style.maxHeight = null;
			// item.style.maxHeight = null;
		} else {
			item.style.maxHeight = item.scrollHeight + 20 + "px";
		}
	});
}




// GO BACK BUTTONS
function goBack(){w.history.back()}









// mateput controller
// TODO: mejorar esto a clases y POO
const startMateput = () =>{
	const updateRequired=e=>{if(e.value==''){e.classList.remove('alt')}else{e.classList.add('alt')}}
	if(d.querySelectorAll('.mateputInput')){
		mateput=d.querySelectorAll('.mateputInput');
		mateput.forEach(e=>{
			updateRequired(e);
			e.addEventListener('input',()=>{updateRequired(e)});
		});
	}
}




//Accordion //Desplegable
var acc = d.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click",()=>{
		this.classList.toggle("active");
		// TODO: Hacer que se puede elegir el elemento a acordionar
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
			panel.style.padding = "0";
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
			panel.style.padding = "20px";
		}
	});
}














function scrollAlter(){
	if (d.querySelector('#teamCardsContainer')) {
		d.querySelector('#teamCardsContainer').onwheel = (e) => {
			d.querySelector('#teamCardsContainer').scrollLeft += e.deltaY;
			e.preventDefault();
		};
	}
}




// URL HANDLING
const setUrlVar = ( variable, value = '' ) => {
	var filterQueries = new Array();
	// urlVirg es la url sin variables
	var urlVirg = w.location.href.split('?')[0];
	// urlVars será el vector de variables en la url
	// var urlVars = w.location.href.split('?');
	// urlVars.shift();
	// urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

	var urlVars = getUrlVars();

	var variables = urlVars.map( x => x.split('=')[0] );
	var values  = urlVars.map( x => x.split('=')[1] );

	// c.log(page)


	if(variable){
		if(variables.includes(variable)){
			let j=0;
			urlVars.forEach((item, i) => {
				if ( variables[i] == variable ) {
					// si la categoria es 0 quita el filtro
					if (value != '') { filterQueries[j] = variable + '=' + value; j+=1; }
				} else { filterQueries[j] = item; j+=1; }
			});
		} else if (value != '') {
			urlVars.forEach((item, i) => {
				filterQueries[i] = item;
			});
			filterQueries.push(variable + '=' + value);
		}
	}
	let conector = filterQueries.length != 0 ? '?' : '';
	w.history.replaceState('', 'Title', urlVirg + conector + filterQueries.join('&'));
	// c.log(filterQueries)
	return filterQueries;
}

const getUrlVars = () => {
	var urlVars = w.location.href.split('?');
	urlVars.shift();
	urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

	return urlVars;
}
// END OF URL HANDLING






productSincrotron = {
	qnty:0,
	toDelete:0,
	deleted:0,
	products: [],
	created:[],
	temp:[],
	wipeProducts:(del = false, cantidad = 1)=>{
		d.querySelector('.updateText').innerHTML = "Eliminando productos viejos, esto puede tardar unos minutos, por favor no abandone la pagina";
		let formData = new FormData();
		if(del){formData.append('delete', 'true');
		}else  {formData.append('delete', 'false');}
		formData.append('cantidad', cantidad);
		formData.append('action', 'lt_wipe_products');
		console.log('Dale, eliminá clia');
		ajax2(formData).then(data => {
			console.log(data);
			if(data.toDelete>0){productSincrotron.toDelete=data.toDelete;}
			if(data.qnty>0){
				let porcentage = productSincrotron.deleted * 100 / productSincrotron.toDelete;
				d.querySelector('.loadBarProgress').style.width = porcentage + '%';

				productSincrotron.deleted += cantidad;
				productSincrotron.wipeProducts(true, cantidad);
			} else {
				// productSincrotron.wipeProducts();
				// let porcentage = productSincrotron.created.length * 100 / productSincrotron.qnty;
				// d.querySelector('.loadBarProgress').style.width = porcentage + '%';

				d.querySelector('.loadBarProgress').style.width = '100%';
				d.querySelector('.updateText').innerHTML = "Todos los productos eliminados";
				setTimeout(1000, productSincrotron.productFabrik());
			}
		})
	},
	productFabrik:()=>{
		d.querySelector('.loadBarProgress').style.width = '0%';
		d.querySelector('.updateText').innerHTML = "Creando productos, esto puede tardar unos minutos, por favor no abandone la pagina";
		// productSincrotron.products = [{sku: "6DC CW",Description:''}]
		// productSincrotron.products.unshift({sku: "6DC CW",Description:''});
		// console.log('cantidad de productos a crear: ', productSincrotron.products.length);
		for (var i = 0; i < 1; i++) {
			// productSincrotron.temp.unshift(productSincrotron.products.shift(productSincrotron.products[i]));
			let productoZero = productSincrotron.products.splice(0, 1);
			productoZero[0].imagenes = productoZero[0].imagenes.split(', ');
			console.log('temp imagenes:')
			console.log(productoZero[0].imagenes);
			productSincrotron.temp.unshift(productoZero[0]);
		}

		console.log('envio a fabricar:')
		console.log(productSincrotron.temp);
		let formData = new FormData();
		formData.append('products', JSON.stringify(productSincrotron.temp));
		formData.append('action', 'lt_create_products');
		// console.log('enviando '+productSincrotron.temp.length+' producto/s para crear');
		ajax2(formData).then(data => {
			// console.log('largo del vector temp: ', productSincrotron.temp.length);
			for (var i = 0; i < productSincrotron.temp.length; i++) {
				productSincrotron.created.unshift(productSincrotron.temp.splice(0, 1));
			}
			// console.log(data);
			// console.log('products created: ', productSincrotron.created.length)
			if (productSincrotron.created.length<productSincrotron.qnty) {
			// if (productSincrotron.created.length<3) {
				productSincrotron.productFabrik();
			} else {
				d.querySelector('.updateText').innerHTML = "Productos creados!!";
			}
			let porcentage = productSincrotron.created.length * 100 / productSincrotron.qnty;
			d.querySelector('.loadBarProgress').style.width = porcentage + '%';
		})
	}
}


const lt_upload_file = () => {
	const controller = d.querySelector('.updateController'),
	file = controller.querySelector('[type=file]');
	var formData = new FormData();
	console.clear();
	console.log('subiendo archivo con ajax');
	formData.append('file', file.files[0]);
	formData.append('action', 'lt_upload_file');

	altClassFromSelector('loading', '#updateController', 'updateController')
	ajax2(formData).then(data => {
		console.log(data)
		altClassFromSelector('loaded', '#updateController', 'updateController');
		d.querySelector('.updateText').innerHTML = 'Tabla actualizada!.';
		d.querySelector('.loadBarProgress').style.width = '100%';
		console.log('archivo subido, base de datos actualizada');
		productSincrotron.products = data;
		productSincrotron.qnty = productSincrotron.products.length;
		if(!data.gate0){
			productSincrotron.wipeProducts();
		}
	});
}
// {mode: 'cors'}
async function ajax2(formData, url = lt_data.ajaxurl) {
	try{
		let response = await fetch(url, {
			method: 'POST',
			body: formData,
			mode: 'no-cors',
		});
		return await response.json();
	}catch(err){
		console.error(err);
	}
}

async function ajax3(formData, url = lt_data.ajaxurl) {
	try{
		let response = await fetch(url, {
			method: 'POST',
			body: formData,
		});
		return await response.text();
	}catch(err){
		console.error(err);
	}
}



















// COOKIES HANDLING

function createCookie(n,value,days){if(days){var date=new Date();date.setTime(date.getTime()+(days*24*60*60*1000));var expires="; expires="+date.toUTCString();}else var expires="";d.cookie=n+"="+value+expires+"; path=/";}
// function readCookie  (n){var m=n+"=",a=d.cookie.split(';');for(var i=0;i<a.length;i++){var c=a[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.indexOf(m)==0)return c.substring(m.length,c.length);}return null;}
function readCookie  (n){var m=n+"=",a=d.cookie.split(';');for(var i=0;i<a.length;i++){var c=a[i];while(c.charAt(0)==' ')c=c.substring(1,c.length);if(c.indexOf(m)==0)return c.substring(m.length,c.length);}}
function eraseCookie (n){createCookie(n,"",-1)}






productSelector = {
	allProducts:[],
	currentSearch:[],
	selectors: [],
	setup: ()=>{
		dynamicCont = d.querySelector('.dynamicCont');
		if (dynamicCont) {
			productSelector.getAllProducts();
			productSelector.selectors = [
				d.querySelector('#selectBoxSize'),
				d.querySelector('#selectBoxTipo_1'),
				d.querySelector('#selectBoxTipo_2'),
				d.querySelector('#selectBoxCondicion'),
			];
			// console.log(productSelector.selectors)

			inputs = [...dynamicCont.querySelectorAll('.selectBoxInput')]
			inputs.forEach((input)=>{
				// input.addEventListener('change',productSelector.searchProduct.bind(input))
				// input.onchange = productSelector.searchProduct.bind(input);
				input.onchange = ()=>{productSelector.searchProduct()};
			})
		}
	},

	addToCart:(product)=>{
		product.qty = parseInt(d.querySelector('.dynamicCont .cuantosQnt').value)
		product.code = product.salesforce_id

		cartController.add(product)

		
		d.querySelector('#currentSemiSelection').classList.remove('cond');
		let selected = [...dynamicCont.querySelectorAll('.selectBoxInput:checked')];
		
		setTimeout(()=>{
			selected.forEach((selector)=>{
				d.querySelector('#currentSemiSelection'+selector.name).setAttribute('xlink:href', '#');
			})
			d.querySelector('#currentSemiSelection').classList.add('cond');
		}, 800);

		// TODO: unselect all selected
		// let nuls = [...dynamicCont.querySelectorAll('.selectBoxInput[value="0"]')];
		// nuls.forEach((nul)=>{
		// 	nul.checked = true
		// 	// console.log(nul.name)
		// 	selectBoxControler('','#selectBox'+nul.name,'#selectBoxCurrent'+nul.name)
		// })
		// productSelector.hideUnwantedOptions();
		// console.log(nuls)
	},
	
	getAllProducts: () => {
		var formData = new FormData();
		formData.append( 'action', 'lt_get_all' );

		ajax2(formData).then( data => {
			productSelector.allProducts   = data;
			productSelector.currentSearch = data;
			// console.log(productSelector.allProducts)
		})
	},

	searchProduct:()=>{
		let dynamicCont = d.querySelector('.dynamicCont');
		let selected = [...dynamicCont.querySelectorAll('.selectBoxInput:checked')];
		
		productSelector.currentSearch = productSelector.allProducts;
		
		// filtra los productos que coincidan con la busqueda actual
		selected.forEach((input)=>{
			if(input.value!='0'){
				let key   = input.name.toLowerCase(),
				value = key == 'size' ? input.value.match(/(\d+)/)[0] : input.value;
				
				let helperArray = [];
				productSelector.currentSearch.forEach(product => {
					if( product[key] == value ){ helperArray.push(product) }
				})
				productSelector.currentSearch = helperArray;
			}
		})
		console.log(productSelector.currentSearch);

		// si hay solo un producto encontrado habilitar boton de agregar al carrito
		let uniqueProductFound = productSelector.currentSearch.length == 1,
		btn = dynamicCont.querySelector('.btn');
		btn.disabled = !uniqueProductFound;

		// esconde todos los option que no coincidan con elementos de la busqueda actual
		productSelector.hideUnwantedOptions();

		productSelector.iconPlay();
	},


	hideUnwantedOptions:()=>{ console.log('asi??')
		// esconde todos los option que no coincidan con elementos de la busqueda actual
		let options = [...dynamicCont.querySelectorAll('.selectBoxOption')];
		options.forEach(option=>{
			let input = option.querySelector('.selectBoxInput');
			if (input.value != 0){
				let key   = input.name.toLowerCase(),
				val = key == 'size' ? input.value.match(/(\d+)/)[0] : input.value,
				found = false;
				// search on currentSearch
				productSelector.currentSearch.forEach(product=>{
					if(product[key]==val){
						found = true;
					}
				})
				
				if(found){
					option.style.display = 'block';
				} else {
					option.style.display = 'none';
				}
			}
		})
	},

	iconPlay:()=>{
		let selected = [...dynamicCont.querySelectorAll('.selectBoxInput:checked')];
		selected.forEach((selector)=>{
			d.querySelector('#currentSemiSelection'+selector.name).setAttribute('xlink:href', '#'+selector.value);
			// console.log(selector.name)
			// console.log(selector.value)
			// let input = selector.querySelector('[checked=true]')
			// console.log(input)
		})
		// TODO: hacer el cambio de iconos en el selector de la front page, mas o menos asi:

	},

}











// TODO: pasar todo a minuscula... como no se me ocurrio antes???!?!?
// CART CONTROLLER
cartController = {
	setup:()=>{
		if (d.querySelector('#cotizador')) {
			cartController.ready(false);
			// cartController.getCol('Size');
		}
		cartController.getLocation();
		// cartController.getLocation(false, 'Destino');

		// cartController.cart = JSON.parse(readCookie('cart'));
		// cartController.cart = JSON.parse(readCookie('cart'));
		if(readCookie('cart')){
			JSON.parse(readCookie('cart')).forEach((item, i) => {
				cartController.cart.unshift(new CartItem(item));
				cartController.cart[0].cartUI();

			});
		}

		if (cartController.cart.length<2) {
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#simpleTruck');
			});
		}else{
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#doubleTruck');
			});
		}

		// console.log('la concha de la EXPLORAR')
	},
	currentSemiSelection: {code: false, qty: 1, size: false, tipo_1: false, tipo_2: false, condicion: false, singlePrice: 0},
	containerToAdd:false,
	cart: [],
	allProducts:{},
	locationOrigen:[],
	locationDestino:[],
	getLocation: ( country = false, option = 'Origen' ) => {
		var formData = new FormData();
		formData.append( 'action', 'lt_get_location' );
		if (country) {
			if(option=='Origen'){cartController.locationOrigen['country'] = country;
			}else{cartController.locationDestino['country'] = country;}
			cartController.selectBoxWipe(option+'City');
			formData.append( 'country', country );
			formData.append( 'column', 'city' );
		}else{
			formData.append( 'column', 'country' );
		}
		// console.log(formData);
		ajax2(formData).then( data => {
			// console.log(data)

			JSON.parse(data.location).forEach( e => {
				for(var key in e) {
					var value = e[key].replace(/(?:\r\n|\r|\n)/g, '');
					key = option + key.capitalize();
					// console.log(key);
					// console.log(d.querySelector('#selectBox'+key+' .selectBoxList'))
					var a = cartController.selectBoxOption(key,value),
					input = a.querySelector(".selectBoxInput");
					input.setAttribute('type', 'radio');
					if (country) {
						if(option=='Origen'){functionExecute = "cartController.locationOrigen['city'] = value;console.log(cartController.locationOrigen);";
						}else{functionExecute = "cartController.locationDestino['city'] = value;console.log(cartController.locationDestino);";}
					}else{functionExecute = 'cartController.getLocation("'+value+'", "'+option+'")';}
					input.setAttribute("onchange", functionExecute);
					d.querySelector('#selectBox'+key+' .selectBoxList').insertBefore(a, null);
				}
			});
		})
	},


	finish:()=>{
		console.log('carrito antes de la transforrmacion', cartController.cart)
		cartController.cart.forEach((item, i) => {
			// cartController.getPrice(item.code);
			// console.log(item);

			var formData = new FormData();
			formData.append( 'action', 'lt_cart_end' );
			formData.append( 'cont', item.code );
			formData.append( 'country', cartController.locationOrigen['country'] );
			formData.append( 'city', cartController.locationOrigen['city'] );
			// console.log('formData');
			
			// Display the key/value pairs
			// for (var pair of formData.entries()) {
			// 	console.log(pair[0]+ ', ' + pair[1]); 
			// }
			ajax2(formData).then( data => {
				// console.log(data)
				let singlePrice, currency;
				
				cartItem = d.querySelector('.cartItem[data-code="'+item.code+'"]');
				itemQty = cartItem.querySelector('.cartItemQty').innerText;
				itemPrice = cartItem.querySelector('.cartItemPriceNumber');
				itemCurrency = cartItem.querySelector('.cartItemCurrency');

				if (data[0]) {
					// currency = data[0].currency;
					currency = 'EUR';
					// // TODO: leer el exchange de algun lado
					// TODO: transformar todo al mismo antes de hacer comparaciones ni nada
					exchange = data.pop()
					data.forEach(element => {
						if(element.currency.includes('USD')){
							element.currency = 'EUR'
							element.supplier_price = element.supplier_price * exchange.rate
							element.fixed_price = element.fixed_price * exchange.rate
							element.sale_price = element.sale_price * exchange.rate
						}
					});
					// console.log(data)
					// console.log('EX-change rate SUELTOOO:', exchange)

					if (data[0].fixed_price!=0) {
						singlePrice = parseFloat(data[0].fixed_price)
					}else if(data[0].sale_price!=0){
						singlePrice = parseFloat(data[0].sale_price - 300)
					}else if(!data[1]){
						singlePrice = parseFloat(data[0].supplier_price)
					}else{
						let prices = data.map( x => x.supplier_price );
						let pricesSort = prices.sort((a,b) => a - b).slice(0, 2);
						let average = (parseInt(pricesSort[0]) + parseInt(pricesSort[1])) / 2;
						singlePrice = average + 200;
					}
					totalPrice = singlePrice * parseInt(itemQty);

				} else {
					currency = '';
					singlePrice = 0;
					totalPrice = 'NaN';
				}
				
				// const check = (element) => {
				// 	return element.code == x.code;
				// }
				// // if (cartController.cart.find(check)) {
				// let index = cartController.cart.findIndex(check)
				// cartController.cart[index].setQty(parseInt(cartController.cart[index].qty) + parseInt(x.qty));
				cartController.cart[i].setPrice(singlePrice);
				nuevoElemento = new CartItem(cartController.cart[i].values)
				cartController.cart[i] = nuevoElemento;
				// console.log('El NUEVO ELEMENTO!!!',new CartItem(cartController.cart[i].values))
				// console.log(cartController.cart[i]);


				// TODO chequear que lleguen todas las respuestas, no que estemos en la ultima
				if (i==cartController.cart.length - 1){
					console.log('CARRITO luego de la transformacion', cartController.cart)
					cartController.sendMail();
				}
				// d.querySelector('.cartItem[data-code="'+x.code+'"] .cartItemQty').innerText = parseInt(d.querySelector('.cartItem[data-code="'+x.code+'"] .cartItemQty').innerText) + parseInt(x.qty);
				// }



				itemCurrency.innerText = currency
				itemPrice.innerText = totalPrice;
			})
		});
		altClassFromSelector('alt', '#finalizarConsulta')
		d.querySelector('#cart').classList.add('alt')
		// console.log('send Mail')
		// console.log(cartController.cart)


		let info = {
			fname:   'Desde el otro lugar',
			lname:   'tambien llega el testeo?',
			email:   'email@test.fake',
			phone:   '0800 666 696969',
			company: 'test company',
			country: 'my country',
			city:    'a city',
			code:    'the product code',
			type:    'product type',
			size:    'product size',
			quantity:'product quantity',
			message: 'el mensajeeeee',
		}
		cartController.newLead(info);
	},


	sendMail:(cart)=>{
		// console.log(cart)
		// cart[0].toJSON="I won't allow you to use sails toJSON, just use the native stringification";
		// console.log(JSON.stringify(cart))
		var formData = new FormData();
		formData.append( 'action', 'lt_ajax_mail' );
		formData.append( 'cont', JSON.stringify(cartController.cart) );
		formData.append( 'country', cartController.locationOrigen['country'] );
		formData.append( 'city', cartController.locationOrigen['city'] );
		formData.append( 'name', d.querySelector('#mateputNombre').value );
		formData.append( 'phone', d.querySelector('#mateputTelefono').value );
		formData.append( 'mail', d.querySelector('#mateputEmail').value );


		ajax2(formData).then( data => {
			console.log(data);
		});
	},


		
		// info = {
		// 	fname:   'Fake',
		// 	lname:   'Name',
		// 	email:   'email@test.fake',
		// 	phone:   '0800 666 696969',
		// 	company: 'test company',
		// 	country: 'my country',
		// 	city:    'a city',
		// 	code:    'the product code',
		// 	type:    'product type',
		// 	size:    'product size',
		// 	quantity:'product quantity',
		// 	message: 'el mensajeeeee',
		// }
		// cartController.newLead(info)



		// var formData = new FormData();
		// formData.append( 'action', 'lt_new_lead' );
		// formData.append( 'oid', oid );
		// formData.append( 'retURL'    , retURL );
		// formData.append( 'debug'     , debug );
		// formData.append( 'debugEmail', debugEmail );
		// formData.append( 'first_name', first_name );
		// formData.append( 'last_name', last_name );
		// formData.append( 'email', email );
		// formData.append( 'phone', phone );
		// formData.append( 'company', company );
		// formData.append( 'country', country );
		// formData.append( 'city', city );
		// formData.append( '00N0X00000CrHzi', product );
		// formData.append( '00N0X00000AlPaB', type );
		// formData.append( '00N0X00000AlPaA', size );
		// formData.append( '00N0X00000AlPaC', quantity );
		// formData.append( '00N0X00000AlPa9', message );
		


	newLead:(info)=>{
		
		// let oid = '00D1l0000000ia7';
		// let retURL  = 'https://silverseacontainers.com/';
		// let debug   = 1;
		// let debugEmail = 'gportela@silverseacontainers.com';
		let first_name = info.fname;
		let last_name  = info.lname;
		let email      = info.email;
		let phone      = info.phone;
		let company    = info.company;
		let country    = info.country;
		let city       = info.city;
		let product    = info.code;
		let type       = info.type;
		let size       = info.size;
		let quantity   = info.quantity;
		let message    = info.message;

		let vars = '?first_name='+first_name+'&last_name='+last_name+'&email='+email+'&phone='+phone+'&company='+company+'&country='+country+'&city='+city+'&product='+product+'&type='+type+'&size='+size+'&quantity='+quantity+'&message='+message;

		let baseURL= 'https://silverseacontainers.com/testLead.php';

		let url = baseURL + vars;
		window.open(url,'_blank');
			
		// var formData = new FormData();
		// formData.append( 'action', 'lt_new_lead' );
		// // formData.append( 'oid', '00D1l0000000ia7' );
		// // formData.append( 'retURL'    , 'https://silverseacontainers.com/' );
		// // formData.append( 'debug'     , 1 );
		// // formData.append( 'debugEmail', 'gportela@silverseacontainers.com' );
		// // formData.append( 'first_name', 'Fake' );
		// // formData.append( 'last_name', 'Name' );
		// // formData.append( 'email', 'test@email.fake' );
		// // formData.append( 'phone', '0800 666 696969' );
		// // formData.append( 'company', 'test company' );
		// // formData.append( 'country', 'my country' );
		// // formData.append( 'city', 'a city' );
		// // formData.append( '00N0X00000CrHzi', 'the product code' );
		// // formData.append( '00N0X00000AlPaB', 'product type' );
		// // formData.append( '00N0X00000AlPaA', 'product size' );
		// // formData.append( '00N0X00000AlPaC', 'product quantity' );
		// // formData.append( '00N0X00000AlPa9', 'please help me' );

		// ajax3(formData, 'https://silverseacontainers.com/testLead.php').then( data => {
		// 	console.log(data)
		// })
	},
	add: (x) => {
		const check = (element) => {
			return element.code == x.code;
		}
		if (cartController.cart.find(check)) {
			let index = cartController.cart.findIndex(check)
			cartController.cart[index].setQty(parseInt(cartController.cart[index].qty) + parseInt(x.qty));
			d.querySelector('.cartItem[data-code="'+x.code+'"] .cartItemQty').innerText = parseInt(d.querySelector('.cartItem[data-code="'+x.code+'"] .cartItemQty').innerText) + parseInt(x.qty);
		} else {
			cartController.cart.unshift(new CartItem(x));
			cartController.cart[0].cartUI();
			// console.log(cartController.cart)
		}
		if (cartController.cart.length<2) {
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#simpleTruck');
			});
		}else{
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#doubleTruck');
			});
		}


		// console.log(cartController.cart);
		createCookie('cart', JSON.stringify(cartController.cart));

	},
	remove:(code)=>{
		console.log(code)
		list = d.querySelector('.cartList');
		list.removeChild(list.querySelector('.cartItem[data-code="'+code+'"]'));

		const check = (element) => {
			return element.code == code;
		}
		cartController.cart.splice(cartController.cart.findIndex(check), 1)
		if (cartController.cart.length<2) {
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#simpleTruck');
			});
		}else{
			d.querySelectorAll('.cartButtonUse').forEach((item, i) => {
				item.setAttribute('xlink:href', '#doubleTruck');
			});
		}
		createCookie('cart', JSON.stringify(cartController.cart));
	},
}




class CartItem {
	constructor(v){
		// TODO: quitar la propiedad "values" y reemplazar por nueva implementacion
		this.values = v;
		// this.singlePrice = 0;
		// Esta parte define las propiedades del elemento como vienen del objeto v
		for(var k in v){Object.defineProperty(this,k,{enumerable: true,value:v[k],writable: true})}
	}

	setQty(x){
		this.qty = x;
		this.values.qty = x;
	}
	setPrice(x){
		this.singlePrice = x;
		this.values.singlePrice = x;
	}


	cartUI(){
		let cartItemTemplate = d.importNode(d.querySelector("#cartItemTemplate").content, true);
		// console.log(cartItemTemplate);
		let cartItem = cartItemTemplate.querySelector(".cartItem");
		cartItem.setAttribute('data-code', this.code);

		let cartItemQty = cartItemTemplate.querySelector(".cartItemQty");
		let cartItemCode = cartItemTemplate.querySelector(".cartItemCode");

		let cartItemSize = cartItemTemplate.querySelector(".cartItemSize .use");
		let cartItemTip1 = cartItemTemplate.querySelector(".cartItemTip1 .use");
		let cartItemTip2 = cartItemTemplate.querySelector(".cartItemTip2 .use");
		let cartItemCond = cartItemTemplate.querySelector(".cartItemCond .use");

		let close = cartItemTemplate.querySelector(".close");

		cartItemQty.innerText = this.qty;
		cartItemCode.innerText = this.code;
		// cartItemQty.innerText = this.ord;
		cartItemSize.setAttribute('xlink:href', '#' + this.size + '-pies');
		cartItemTip1.setAttribute('xlink:href', '#' + this.tipo_1);
		cartItemTip2.setAttribute('xlink:href', '#' + this.tipo_2);

		cartItemCond.setAttribute('xlink:href', '#' + this.condicion.replace(/\s/g, '-').toUpperCase());

		close.setAttribute('onclick', 'cartController.remove("' + this.code + '")');


    d.querySelector('.cartList').insertBefore(cartItemTemplate, null);
	}
}


// formElement = document.querySelector('form');
// console.log(new URLSearchParams(new FormData(formElement)).toString())



// jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error

// 	data = "oid=00D1l0000000ia7&retURL=https%3A%2F%2Fsstc.com.es%2F&debug=1&debugEmail=gportela%40silverseacontainers.com&first_name=Cosme&last_name=Fulanito&email=test%40fake.email&phone=1234567890&company=THE+company&country=here&city=exactly+here&00N0X00000CrHzi=20FR+CW&00N0X00000AlPaB=container&00N0X00000AlPaA=big&00N0X00000AlPaC=22&00N0X00000AlPa9=yet+another+test";
// 	action = "https://go.pardot.com/l/821023/2020-06-02/8qk1";
// 	$.ajax({
// 		url: action,
// 		method: 'POST',
// 		data: data,
// 		dataType: 'jsonp'
// 	})
// })