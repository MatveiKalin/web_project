<div id="left_menu">
    <ul>
        <li><a href="<?php echo '/user/' . $_SESSION['user_id']; ?>">Моя страница</a></li>
        <li><a href="<?php echo '/registerUsers/' . $_SESSION['user_id']; ?>">Зарегистрированные пользователи</a></li>
        <li><a href="<?php echo '/interlocutor/' . $_SESSION['user_id']; ?>">Собеседники</a></li>
        <li><a href="<?php echo '/user/writeCommonMessage/' . $_SESSION['user_id']; ?>">Общий чат</a></li>
        <li><a href="<?php echo '/user/writeMessageToMail/' . $_SESSION['user_id']; ?>">Отправить на электронную почту</a></li>
    </ul>
</div>