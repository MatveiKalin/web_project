// инициализировать кэш запросов
var cache = new Array();

// запомнить ссылку на объект XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();

// создать объект XMLHttpRequest
function createXmlHttpRequestObject() {

	// переменная для хранения ссылки на объект XMLHttpRequest
	var xmlHttp;

	// эта часть кода должна работать во всех броузерах, за исключением
	// IE6 и более старых его версий
	try {
		// попытаться создать объект XMLHttpRequest
		xmlHttp = new XMLHttpRequest();
	}
	catch(e) {
		// предполагается, что в качестве броузера используется
		// IE6 или более старая его версия
		var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
										"MSXML2.XMLHTTP.5.0",
										"MSXML2.XMLHTTP.4.0",
										"MSXML2.XMLHTTP.3.0",
										"MSXML2.XMLHTTP",
										"Microsoft.XMLHTTP");

		// попробовать все возможные prog id,
		// пока какая-либо попытка не увенчается успехом
		for (var i = 0; i < XmlHttpVersions.length && !xmlHttp; i++) {
			try {
				// попытаться создать объект XMLHttpRequest
				xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
			}
			catch (e) {} // игнорировать возможные ошибки
		}
	}

	// вернуть созданный объект или вывести сообщение об ошибке
	if (!xmlHttp)
		alert("Ошибка создания объекта XMLHttpRequest.");
	else
		return xmlHttp;
}


// выполнить асинхронный запрос HTTP с помощью объекта XMLHttpRequest
function process(inputValue, fieldID) {


	inputValue = encodeURIComponent(inputValue);
	fieldID = encodeURIComponent(fieldID);

	// добавить значения в очередь
	cache.push("inputValue=" + inputValue + "&fieldID=" + fieldID);

	/// продолжать только если объект XMLHttpRequest не занят и кэш не пуст
	if ( (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) && cache.length > 0) {

		// извлечь новый набор параметров из кэша
		var cacheEntry = cache.shift();

		//alert(cacheEntry);


		// послать запрос серверу для проверки извлеченных данных
		xmlHttp.open("POST", "../../controllers/validate_registration_AJAX.php", true);

		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		// определить метод, который будет обрабатывать ответы сервера
		xmlHttp.onreadystatechange = handleServerResponse;

		// послать асинхронный запрос серверу
		xmlHttp.send(cacheEntry);

	}
	else
		// если соединение занято, повторить попытку через одну секунду
		setTimeout('process()', 1000);
}

// вызывается автоматически по прибытии сообщения от сервера
function handleServerResponse() {

	// продолжать можно только если транзакция с сервером завершена
	if (xmlHttp.readyState == 4) {

		// значение 200 говорит о том, что транзакция прошла успешно
		if (xmlHttp.status == 200) {
			/*
			// получить ответ в формате XML (предполагается корректный формат XML)
			responseXml = xmlHttp.responseXML;

			// получить ссылку на корневой элемент
			xmlDoc = responseXml.documentElement;

			result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
			fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;

			// отыскать элемент HTML, в котором следует вывести сообщение об ошибке
			message = document.getElementById(fieldID);

			// показать или спрятать сообщение
			message.className = (result == "0") ? "block" : "none";

			// вызвать validate() еще раз, на случай, если кэш не пуст
			setTimeout("validate();", 500);
			*/


			// получить ответ в формате XML (предполагается корректный формат XML)
			responseXml = xmlHttp.responseXML;

			// получить ссылку на корневой элемент
			xmlDoc = responseXml.documentElement;

			//result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
			//fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;

			// Проходим по полученному документу XML
			for (var i = 0; i < xmlDoc.getElementsByTagName("result").length+1; i++) {

				result = xmlDoc.getElementsByTagName("result")[i].firstChild.data;
				fieldID = xmlDoc.getElementsByTagName("fieldid")[i].firstChild.data;

				// отыскать элемент HTML, в котором следует вывести сообщение об ошибке
				message = document.getElementById(fieldID);

				// показать или спрятать сообщение
				message.className = (result == "0") ? "block" : "none";
			}

			// вызвать validate() еще раз, на случай, если кэш не пуст
			setTimeout("validate();", 500);

		}
		// код статуса HTTP, отличный от 200, говорит о наличии ошибки
		else {
			alert("При обращении к серверу возникли проблемы: " + xmlHttp.statusText);
		}
	}

}