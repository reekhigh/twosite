<?php

/**
 * Контроллер CartController
 */
class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        // Список категорий для левого меню
        $categories = Category::getCategoriesList();

        // Список последних товаров
        $latestProducts = Product::getLatestProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action для страницы "Контакты"
     */
    public function actionContact()
    {

        // Переменные для формы
        $userNum = false;
        $userName = false;
        $userText = false;
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $userNum = $_POST['userNum'];
            $userName = $_POST['userName'];
            $userText = $_POST['userText'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            // if (!User::checkEmail($userEmail)) {
                // $errors[] = 'Неправильный email';
            // }

if (empty($userNum)) {
        $errors[] = 'В строке пусто...';
    }

    if (!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $userNum)) {
        $errors[] = 'Неправильный телефон..1.';
    }





            if ($errors == false) {
                // Если ошибок нет
                // Отправляем письмо администратору 
                $adminEmail = 'ipiontsev@gmail.com';
                $message = "Текст: {$userText}.| Кому звонить {$userNum}. | Имя клиента {$userName}";
                $subject = 'Новая заявка с сайта по квартирам!';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/site/contact.php');
        return true;
    }
    
    /**
     * Action для страницы "О магазине"
     */
    public function actionAbout()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
