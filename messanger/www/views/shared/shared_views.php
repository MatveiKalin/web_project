<?php

// Выводим верхнюю часть HTML-документа
function top_html_doc_view() { 

	echo '<!DOCTYPE html>';
	echo '<html>';
	echo '<head>';
		echo '<meta charset="utf-8">';
		echo '<title>Обмен сообщениями</title>';
		echo '<link href="../css/style.css" rel="stylesheet" />';
	echo '</head>';
	echo '<body>';

} // Конец функции "top_html_doc_view()"



function header_view() { 

	echo '<div id="header">';
		echo '<h2>Обмен сообщениями</h2>';
		echo '<a href="#" id="out">Выход из учетной записи</a>';
	echo '</div>';

}


function left_menu_view() { 

	echo '<div id="left_menu">';
		echo '<ul>';
			echo '<li><a href="#">Моя страница</a></li>';
			echo '<li><a href="#">Зарегистрированные пользователи</a></li>';
			echo '<li><a href="interlocutor_controller.php?action=list_interlocutors">Собеседники</a></li>';
			echo '<li><a href="#">Общий чат</a></li>';
		echo '</ul>';
	echo '</div>';
	
}



function footer_view() { 

	echo '<div id="footer">Группа РИС-14-1б</div>';

}



// Выводим нижнюю часть HTML-документа
function bottom_html_doc_view() { 

	echo '</body>';	
	echo '</html>';

} // Конец функции "bottom_html_doc_view()"


?>