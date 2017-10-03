Тестовое задание

Необходимо разработать импорт из json файла со структурой каталога, который будет сохранять данные в базу, с сохранением иерархии. У каждой категории должна быть ссылка, полученная из ее названия с помощью транслитерации (пробелы должны заменяться на тире). Ссылки так же должны быть со сохранением иерархии.

Идентификатор категории всегда состоит из латинской буквы и 8 цифр, буква у категории первого уровня всегда D, у второго - C, у третьего - S. Ид уникален, как комбинация буква + цифры, т.е. допустимы варианты S00000001 и D00000001, но одинаковые, например, S00000001 дважды -  исключены. Подкатегории переезжать в другую родительскую категорию или удаляться не будут, новые появляться могут.

Помимо импорта необходима страница с выводом сохранённых в базе категорий в виде дерева.  Для оформления можно использовать теги маркированного списка. 

Каждая категория в этом дереве должна быть ссылкой, которая ведет на отдельную страницу с информацией о категории. 

На странице категории нужно вывести путь к ней, её категории и идентификатор.

При последующем использовании импорта, те данные которые уже были сохранены должны обновляться.

Если категория изменила свое название, и была сгенерирована новая ссылка, то все прежние ссылки этой категории должны вести на новую через 301 редирект.

Инструменты
- Laravel
- MySQL

Demo: http://dt.kulaga.me/