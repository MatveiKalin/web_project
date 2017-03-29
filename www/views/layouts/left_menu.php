<div id="left_menu">
    <ul>
        <li><a href="<?php echo '/user/' . $_SESSION['user_id']; ?>">Моя страница</a></li>
        <li><a href="<?php echo '/registerUsers/' . $_SESSION['user_id']; ?>">Зарегистрированные пользователи</a></li>
        <li><a href="<?php echo '/interlocutor/' . $_SESSION['user_id']; ?>">Собеседники</a></li>
        <li><a href="common.php">Общий чат</a></li>
    </ul>
</div>