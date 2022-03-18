let cart = get_cart()
function get_cart() {
	return JSON.parse(localStorage.getItem('cart')) || []
}
function add_to_cart(id, name, img, price) {
	cart.push([id, name, img, price])
	localStorage.setItem('cart', JSON.stringify(cart))
}
function clear_cart() {
	cart = []
	localStorage.setItem('cart', JSON.stringify(cart))
}
function clear_cart_btn() {
	clear_cart()
	document.querySelector(".cart-items").innerHTML = print_cart()
	document.querySelector("#checkout-form").style.display = 'none'
}
function add_to_cart_btn(btn, id, name, img, price) {
	add_to_cart(id, name, img, price)
	btn.innerHTML = "<i class='icon'>check</i> افزوده شد."
	setTimeout(() => {
		btn.innerHTML =
			"<i class='icon'>add_shopping_cart</i> افزودن به سبد خرید"
	}, 2000)
}
function print_cart() {
	if(!cart.length)
		return '<p>سبد خرید شما خالی است.</p>'

	let total_price = 0
	let html = `<button type='button' `
	html += `onclick='clear_cart_btn()'>`
	html += `<i class='icon'>remove_shopping_cart</i> `
	html += `خالی کردن سبد خرید`
	html += `</button>`
	for(const c of cart) {
		html += `<div class='cart-item'>`
		html += `<img src='${c[2]}'>`
		html += `<h3>${c[1]}</h3>`
		html += `<p>${c[3]}</p>`
		html += `</div>`
		total_price += en_price(c[3])
	}
	total_price = fa_price(total_price)
	html += `<span>قیمت کل: ${total_price}</span>`
	return html
}
function en_num(str) {
	const fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹']
	const en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
	for(const i in fa)
		str = str.replace(new RegExp(fa[i], 'g'), en[i])
	return str
}
function en_price(price) {
	return parseInt(en_num(price).replace(/,/g, ''))
}
function fa_num(str) {
	const en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']
	const fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹']
	for(const i in en)
		str = str.replace(new RegExp(en[i], 'g'), fa[i])
	return str
}
function fa_price(price) {
	return fa_num(price.toLocaleString()) + ' تومان'
}
function get_str(inp) {
	return inp.value.trim()
}
function get_cart_ids() {
	const ids = []
	for(const c of cart)
		ids.push(c[0])
	return ids.join(',')
}
function add_product(e) {
	const form_el = document.querySelector('#product-form')
	const submit_el = form_el.querySelector('button')
	const n = get_str(form_el.querySelector('#name'))
	const c = get_str(form_el.querySelector('#cat'))
	const d = get_str(form_el.querySelector('#desc'))
	const i = get_str(form_el.querySelector('#img'))
	const p = get_str(form_el.querySelector('#price'))

	const url = '../src/product-api.php'

	const request = `job=add&name=${n}&cat=${c}&desc=${d}&img=${i}&price=${p}`

	submit_form(e, url, request, submit_el,
		    'افزودن محصول',
		    `<i class='icon'>check</i> محصول اضافه شد.`,
		    `<i class='icon'>error</i> لطفا همه موارد را کامل کنید.`)
}
function checkout(e) {
	const form_el = document.querySelector('#checkout-form')
	const submit_el = form_el.querySelector('button')
	const name_el = form_el.querySelector('#name')
	const phone_el = form_el.querySelector('#phone')
	const address_el = form_el.querySelector('#address')

	const info = encodeURIComponent(JSON.stringify({
		name: get_str(name_el),
		phone: get_str(phone_el),
		address: get_str(address_el),
	}))

	const products = encodeURIComponent(get_cart_ids())

	const url = 'src/purchase-api.php'
	
	const request = `job=add&products=${products}&info=${info}`

	submit_form(e, url, request, submit_el,
		    `نهایی‌کردن خرید`,
		    `<i class='icon'>check</i> خرید شما نهایی شد. متشکریم!`,
		    `<i class='icon'>error</i> لطفا همه موارد را کامل کنید.`)
}
function submit_form(e, url, request, submit_el, def, success, fail) {
	e.preventDefault()
	
	submit_el.innerHTML = `<i class='load'></i>`

	post_url(url, request, res => {
		res = JSON.parse(res)
		if(res === true) {
			submit_el.innerHTML = success
			submit_el.setAttribute('disabled', 'true')
		}
		else {
			submit_el.innerHTML = fail
			setTimeout(() => {
				submit_el.innerHTML = def
			}, 2000)
		}
	})
}
function post_url(url, request, callback) {
	const client = new XMLHttpRequest
	client.onload = () => callback(client.responseText)
	client.open('post', url)
	client.setRequestHeader('Content-type',
				'application/x-www-form-urlencoded')
	client.send(request)
}
